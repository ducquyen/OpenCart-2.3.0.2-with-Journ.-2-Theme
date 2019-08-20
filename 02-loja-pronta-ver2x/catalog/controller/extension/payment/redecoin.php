<?php
class ControllerExtensionPaymentRedecoin extends Controller {
	public function index() {
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['text_loading'] = $this->language->get('text_loading');

		$data['continue'] = $this->url->link('extension/payment/redecoin/address');

		return $this->load->view('extension/payment/redecoin', $data);
	}

	public function confirm() {
		
		if ($this->session->data['payment_method']['code'] == 'redecoin') {

			$this->load->model('checkout/order');
			$this->load->model('extension/payment/redecoin');

			$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
			
			$params = array();
			$params["token"] = $this->config->get('redecoin_token');
			$params["amount"] = $order_info['total'];
			$params["iso4217"] = "BRL";
			$params["email_client"] = utf8_encode($this->customer->getEmail());
			$params["refer_id"] = $order_info['order_id'];
			
			try {
				$params_str = implode('&', 
								array_map(
						  		    function ($v, $k) { return sprintf("%s=%s", $k, $v); },
									    $params,
									    array_keys($params)
									)
							);

				$order_redecoin = file_get_contents("https://api.redecoin.com/v1/transacao/criar/?" . $params_str);

				if(!$order_redecoin) {
					$curl = curl_init();
					curl_setopt_array($curl, array(
						    CURLOPT_RETURNTRANSFER => 1,
						    CURLOPT_URL => "https://api.redecoin.com/v1/transacao/criar/?" . $params_str,
						    CURLOPT_USERAGENT => 'Opencart Agent'
						)
					);
					$order_redecoin = curl_exec($curl);

					curl_close($curl);
				}

			} catch (Exception $e) {
			}

			if ($order_redecoin = json_decode($order_redecoin, TRUE)) {
				$this->session->data['order_redecoin'] = $order_redecoin;
				
				if ("1" == substr($order_redecoin["status"], 0, 1)) {
					$this->model_extension_payment_redecoin->updateOrder($order_info['order_id'], $order_redecoin["resp"]["token"]);
				}
			}

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('redecoin_order_status_id_pending'));
		}
	}

	public function address() {
		$this->load->language('extension/payment/redecoin');
		$this->document->setTitle($this->language->get('heading_title'));

		$data = array();

		$data['continue'] = $this->url->link('checkout/success');
		$data['order_redecoin'] = $this->session->data['order_redecoin'];
		
		$data['text_order_registered'] = $this->language->get("text_order_registered");
		$data['text_payment_instruction'] = sprintf($this->language->get("text_payment_instruction"), $data['order_redecoin']['resp']['valBtc']);
		$data['text_i_paid'] = $this->language->get("text_i_paid");

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('extension/payment/redecoin_form', $data));

	}

	public function notify() {
		if (isset($this->request->post['token']) && $this->request->post['token']) {

			$params["secret_key"] = $this->config->get('redecoin_secret_key');
			$params["token"] = $this->request->post['token'];
			
			$order_redecoin = file_get_contents("https://api.redecoin.com/v1/transacao/listar/?" . implode('&', 
					array_map(
					    function ($v, $k) { return sprintf("%s=%s", $k, $v); },
						    $params,
						    array_keys($params)
						)
					)
				);

			if ($order_redecoin = json_decode($order_redecoin, TRUE)) {
				if (isset($order_redecoin["resp"][0]['status_transacao'])) {
					$orc = $order_redecoin["resp"][0];
					if(!isset($orc['comment'])){
						$orc['comment'] = "";
					}
					
					$this->load->model('checkout/order');
					$this->load->model('extension/payment/redecoin');

					$order_info = $this->model_checkout_order->getOrder($orc['refer_id']);
					if ($order_info) {
						if ("aprovado" == $orc['status_transacao']) {
							$this->model_checkout_order->addOrderHistory($orc['refer_id'], $this->config->get('redecoin_order_status_id_processing'), $orc['comment']);
						} else if ("negado" == $orc['status_transacao']) {
							$this->model_checkout_order->addOrderHistory($orc['refer_id'], $this->config->get('redecoin_order_status_id_denied'), $orc['comment']);
						} else if ("cancelado" == $orc['status_transacao']) {
							$this->model_checkout_order->addOrderHistory($orc['refer_id'], $this->config->get('redecoin_order_status_id_canceled'), $orc['comment']);
						}
					}
				}
			}
		}
	}

}
