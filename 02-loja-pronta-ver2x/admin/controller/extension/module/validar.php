<?php
class ControllerExtensionModuleValidar extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/validar');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('validar', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_aviso'] = $this->language->get('text_aviso');
		$data['text_ajuda'] = $this->language->get('text_ajuda');
		$data['text_suporte'] = $this->language->get('text_suporte');
		$data['entry_cpf'] = $this->language->get('entry_cpf');
		$data['entry_cnpj'] = $this->language->get('entry_cnpj');
		$data['entry_misto'] = $this->language->get('entry_misto');
		$data['entry_ativar'] = $this->language->get('entry_ativar');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['help_cpf'] = $this->language->get('help_cpf');
		$data['help_cnpj'] = $this->language->get('help_cnpj');
		$data['help_misto'] = $this->language->get('help_misto');
		
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
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/validar', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/validar', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		if (isset($this->request->post['validar_cpf'])) {
			$data['validar_cpf'] = $this->request->post['validar_cpf'];
		} else {
			$data['validar_cpf'] = $this->config->get('validar_cpf');
		}
		
		if (isset($this->request->post['validar_cnpj'])) {
			$data['validar_cnpj'] = $this->request->post['validar_cnpj'];
		} else {
			$data['validar_cnpj'] = $this->config->get('validar_cnpj');
		}
		
		if (isset($this->request->post['validar_misto'])) {
			$data['validar_misto'] = $this->request->post['validar_misto'];
		} else {
			$data['validar_misto'] = $this->config->get('validar_misto');
			
		}
		
		if (isset($this->request->post['validar_ativo'])) {
			$data['validar_ativo'] = $this->request->post['validar_ativo'];
		} else {
			$data['validar_ativo'] = $this->config->get('validar_ativo');
			
		}
		
		if (isset($this->request->post['validar_ativo1'])) {
			$data['validar_ativo1'] = $this->request->post['validar_ativo1'];
		} else {
			$data['validar_ativo1'] = $this->config->get('validar_ativo1');
			
		}
		
		if (isset($this->request->post['validar_ativo2'])) {
			$data['validar_ativo2'] = $this->request->post['validar_ativo2'];
		} else {
			$data['validar_ativo2'] = $this->config->get('validar_ativo2');
			
		}
		
		
$this->load->model('customer/custom_field');
$data['custom_fields'] = $this->model_customer_custom_field->getCustomFields();
		$data['link_custom_field'] = $this->url->link('customer/custom_field', 'token=' . $this->session->data['token'], true);
	
		if (isset($this->request->post['validar_status'])) {
			$data['validar_status'] = $this->request->post['validar_status'];
		} else {
			$data['validar_status'] = $this->config->get('validar_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/validar', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/validar')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}