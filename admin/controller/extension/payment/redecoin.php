<?php
class ControllerExtensionPaymentRedecoin extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/redecoin');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('redecoin', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_info'] = $this->language->get('text_info');

		$data['entry_order_status_pending'] = $this->language->get('entry_order_status_pending');
		$data['entry_order_status_canceled'] = $this->language->get('entry_order_status_canceled');
		$data['entry_order_status_denied'] = $this->language->get('entry_order_status_denied');
		$data['entry_order_status_processing'] = $this->language->get('entry_order_status_processing');

		$data['entry_iso4217'] = $this->language->get('entry_iso4217');
		$data['entry_notify'] = $this->language->get('entry_notify');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_token'] = $this->language->get('entry_token');
		$data['entry_secret_key'] = $this->language->get('entry_secret_key');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_notify'] = $this->language->get('help_notify');
		$data['help_iso4217'] = $this->language->get('help_iso4217');
		$data['help_total'] = $this->language->get('help_total');
		$data['help_token'] = $this->language->get('help_token');
		$data['help_secret_key'] = $this->language->get('help_secret_key');
		$data['help_order_status_pending'] = $this->language->get('help_order_status_pending');
		$data['help_order_status_canceled'] = $this->language->get('help_order_status_canceled');
		$data['help_order_status_denied'] = $this->language->get('help_order_status_denied');
		$data['help_order_status_processing'] = $this->language->get('help_order_status_processing');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['redecoin_notify'] = HTTPS_CATALOG . 'index.php?route=extension/payment/redecoin/notify';
		$data['redecoin_logo'] = HTTPS_SERVER . 'view/image/payment/redecoin-icon.png';

		$data['redecoin_iso4217'] = 'BRL';

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/redecoin', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/redecoin', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);

		if (isset($this->request->post['redecoin_total'])) {
			$data['redecoin_total'] = $this->request->post['redecoin_total'];
		} else {
			$data['redecoin_total'] = $this->config->get('redecoin_total');
		}

		if (isset($this->request->post['redecoin_order_status_id_pending'])) {
			$data['redecoin_order_status_id_pending'] = $this->request->post['redecoin_order_status_id_pending'];
		} else {
			$data['redecoin_order_status_id_pending'] = $this->config->get('redecoin_order_status_id_pending');
		}

		if (isset($this->request->post['redecoin_order_status_id_canceled'])) {
			$data['redecoin_order_status_id_canceled'] = $this->request->post['redecoin_order_status_id_canceled'];
		} else {
			$data['redecoin_order_status_id_canceled'] = $this->config->get('redecoin_order_status_id_canceled');
		}

		if (isset($this->request->post['redecoin_order_status_id_processing'])) {
			$data['redecoin_order_status_id_processing'] = $this->request->post['redecoin_order_status_id_processing'];
		} else {
			$data['redecoin_order_status_id_processing'] = $this->config->get('redecoin_order_status_id_processing');
		}

		if (isset($this->request->post['redecoin_order_status_id_denied'])) {
			$data['redecoin_order_status_id_denied'] = $this->request->post['redecoin_order_status_id_denied'];
		} else {
			$data['redecoin_order_status_id_denied'] = $this->config->get('redecoin_order_status_id_denied');
		}

		if (isset($this->request->post['redecoin_secret_key'])) {
			$data['redecoin_secret_key'] = $this->request->post['redecoin_secret_key'];
		} else {
			$data['redecoin_secret_key'] = $this->config->get('redecoin_secret_key');
		}

		if (isset($this->request->post['redecoin_token'])) {
			$data['redecoin_token'] = $this->request->post['redecoin_token'];
		} else {
			$data['redecoin_token'] = $this->config->get('redecoin_token');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['redecoin_status'])) {
			$data['redecoin_status'] = $this->request->post['redecoin_status'];
		} else {
			$data['redecoin_status'] = $this->config->get('redecoin_status');
		}

		if (isset($this->request->post['redecoin_sort_order'])) {
			$data['redecoin_sort_order'] = $this->request->post['redecoin_sort_order'];
		} else {
			$data['redecoin_sort_order'] = $this->config->get('redecoin_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/redecoin', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/redecoin')) {
			$this->error['warning'] = $this->language->get('error_permission');
		} else {
			$this->checkFieldModel();
		}

		return !$this->error;
	}

	private function checkFieldModel() {

		$hasModelChoiceField = FALSE;
		$result = $this->db->query( "DESCRIBE `".DB_PREFIX."order`;" );
		foreach ($result->rows as $row) {
			if ($row['Field'] == 'redecoin_token') {
				$hasModelChoiceField = TRUE;
				break;
			}
		}
		if (!$hasModelChoiceField) {
		 	$sql = "ALTER TABLE `".DB_PREFIX."order` ADD `redecoin_token` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''";
		 	$this->db->query( $sql );
		}
	}
}