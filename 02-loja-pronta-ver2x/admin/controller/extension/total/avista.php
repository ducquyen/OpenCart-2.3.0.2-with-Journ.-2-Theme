<?php
class ControllerExtensionTotalAVista extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/total/avista');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('avista', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_methods'] = $this->language->get('entry_methods');
		$data['help_methods'] = $this->language->get('help_methods');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

      $data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('text_total'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('extension/total/avista', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('extension/total/avista', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['avista_status'])) {
			$data['avista_status'] = $this->request->post['avista_status'];
		} else {
			$data['avista_status'] = $this->config->get('avista_status');
		}

		if (isset($this->request->post['avista_sort_order'])) {
			$data['avista_sort_order'] = $this->request->post['avista_sort_order'];
		} else {
			$data['avista_sort_order'] = $this->config->get('avista_sort_order');
		}

		if (isset($this->request->post['avista_total'])) {
			$data['avista_total'] = $this->request->post['avista_total'];
		} else {
			$data['avista_total'] = $this->config->get('avista_total');
		}

		if (isset($this->request->post['avista_methods'])) {
			$data['avista_methods'] = $this->request->post['avista_methods'];
		} else {
			$data['avista_methods'] = $this->config->get('avista_methods');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/total/avista.tpl', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/total/avista')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
?>
