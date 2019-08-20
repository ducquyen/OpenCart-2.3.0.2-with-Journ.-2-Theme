<?php
class ControllerExtensionModuleWhatsmaster extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/whatsmaster');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('whatsmaster', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_extension'] = $this->language->get('text_extension');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_numero'] = $this->language->get('entry_numero');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
				
		
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
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/whatsmaster', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/whatsmaster', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
	    
		if (isset($this->request->post['whatsmaster_numero'])) {
			$data['whatsmaster_numero'] = $this->request->post['whatsmaster_numero'];
		} else {
			$data['whatsmaster_numero'] = $this->config->get('whatsmaster_numero');
		}
		
		if (isset($this->request->post['whatsmaster_image'])) {
			$data['whatsmaster_image'] = $this->request->post['whatsmaster_image'];
		} else {
			$data['whatsmaster_image'] = $this->config->get('whatsmaster_image');
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['whatsmaster_image']) && is_file(DIR_IMAGE . $this->request->post['whatsmaster_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['whatsmaster_image'], 100, 100);
		} elseif ($this->config->get('whatsmaster_image') && is_file(DIR_IMAGE . $this->config->get('whatsmaster_image'))) {
			$data['thumb'] = $this->model_tool_image->resize($this->config->get('whatsmaster_image'), 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['whatsmaster_status'])) {
			$data['whatsmaster_status'] = $this->request->post['whatsmaster_status'];
		} else {
			$data['whatsmaster_status'] = $this->config->get('whatsmaster_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/whatsmaster', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/whatsmaster')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}