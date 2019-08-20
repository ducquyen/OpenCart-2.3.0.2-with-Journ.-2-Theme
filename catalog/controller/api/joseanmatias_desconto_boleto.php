<?php

class ControllerApiJoseanMatiasDescontoBoleto extends Controller {

    public function methods() {
        $this->load->language('api/payment');

        // Delete past shipping methods and method just in case there is an error
        unset($this->session->data['payment_methods']);
        unset($this->session->data['payment_method']);

        $json = array();

        if (!isset($this->session->data['api_id'])) {
            $json['error'] = $this->language->get('error_permission');
        } else {

            $selected_methods = array();

            if (isset($this->request->post['methods']) && $this->request->post['methods']) {
                $selected_methods = explode(",", $this->request->post['methods']);
            }

            $currency = false;

            if(!isset($this->session->data['currency'])) {
                $currency = $this->config->get('config_currency');
            }

            $this->session->data['currency'] = $currency;

            $payment_address = array(
                'address_id' => 0,
                'zone_id' => $this->config->get('config_zone_id'),
                'country_id' => $this->config->get('config_country_id')
            );

            // Totals
            $total = 10000000;
            $quantity = 1000;

            $product_info = $this->db->query("SELECT product_id, quantity FROM ".DB_PREFIX."product WHERE status = '1' AND quantity > minimum ORDER BY MAX(price) LIMIT 1")->row;

            if($product_info['quantity'] < $quantity) {
                $quantity = $product_info['quantity'];
            }

            $this->cart->add($product_info['product_id'], $quantity);

            // Payment Methods
            $json['payment_methods'] = array();

            $this->load->model('extension/extension');

            $results = $this->model_extension_extension->getExtensions('payment');

            $recurring = $this->cart->hasRecurringProducts();

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('extension/payment/' . $result['code']);

                    $method = $this->{'model_extension_payment_' . $result['code']}->getMethod($payment_address, $total);

                    if ($method) {
                        if ($recurring) {
                            if (property_exists($this->{'model_extension_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_extension_payment_' . $result['code']}->recurringPayments()) {
                                    $json['payment_methods'][$result['code']] = $method;
                            }
                        } else {
                            $json['payment_methods'][$result['code']] = $method;
                        }
                        if (in_array($result['code'], $selected_methods)) {
                            $json['payment_methods'][$result['code']]['selected'] = true;
                        } else {
                            $json['payment_methods'][$result['code']]['selected'] = false;
                        }
                    }
                }
            }

            $sort_order = array();

            foreach ($json['payment_methods'] as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $json['payment_methods']);

            if ($json['payment_methods']) {
                $this->session->data['payment_methods'] = $json['payment_methods'];
            } else {
                $json['error'] = $this->language->get('error_no_payment');
            }

            if($currency) {
                unset($this->session->data['currency']);
            }

            $this->cart->clear();
        }

        if (isset($this->request->server['HTTP_ORIGIN'])) {
            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
            $this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
            $this->response->addHeader('Access-Control-Max-Age: 1000');
            $this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}