<?php

class ControllerExtensionTotalJoseanMatiasDescontoBoleto extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('extension/total/joseanmatias_desconto_boleto');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

            if (strstr($this->request->post['joseanmatias_desconto_boleto_value'], ',')) {
                $this->request->post['joseanmatias_desconto_boleto_value'] = str_replace(',', '.', $this->request->post['joseanmatias_desconto_boleto_value']);
            }

            if (!$this->request->post['joseanmatias_desconto_boleto_sort_order']) {
                $this->request->post['joseanmatias_desconto_boleto_sort_order'] = 2;
            }

            $this->model_setting_setting->editSetting('joseanmatias_desconto_boleto', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true));
        }

        $data['heading_title'] = $this->language->get('heading_title_inner');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_wait'] = $this->language->get('text_wait');
        $data['text_no_payment'] = $this->language->get('text_no_payment');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_loading'] = $this->language->get('text_loading');

        $data['entry_value'] = $this->language->get('entry_value');
        $data['entry_method'] = $this->language->get('entry_method');
        $data['entry_text_list'] = $this->language->get('entry_text_list');
        $data['entry_text_page'] = $this->language->get('entry_text_page');
        $data['entry_price_update'] = $this->language->get('entry_price_update');
        $data['entry_outofstock'] = $this->language->get('entry_outofstock');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_ip_add'] = $this->language->get('button_ip_add');

        $data['token'] = $this->session->data['token'];
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $data['store_url'] = HTTPS_CATALOG;
        } else {
            $data['store_url'] = HTTP_CATALOG;
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        // API login
        $this->load->model('user/api');

        $api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

        if ($api_info) {
            $data['api_id'] = $api_info['api_id'];
            $data['api_key'] = $api_info['key'];
            $data['api_ip'] = $this->request->server['REMOTE_ADDR'];
        } else {
            $data['api_id'] = '';
            $data['api_key'] = '';
            $data['api_ip'] = '';
        }

        if (isset($this->error['desconto_boleto_value'])) {
            $data['error_desconto_boleto_value'] = $this->error['desconto_boleto_value'];
        } else {
            $data['error_desconto_boleto_value'] = '';
        }

        if (isset($this->error['desconto_boleto_method'])) {
            $data['error_desconto_boleto_method'] = $this->error['desconto_boleto_method'];
        } else {
            $data['error_desconto_boleto_method'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], true),
            'text' => $this->language->get('text_home')
        );

        $data['breadcrumbs'][] = array(
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true),
            'text' => $this->language->get('text_total')
        );

        $data['breadcrumbs'][] = array(
            'href' => $this->url->link('extension/total/joseanmatias_desconto_boleto', 'token=' . $this->session->data['token'], true),
            'text' => $this->language->get('heading_title_inner')
        );

        $data['action'] = $this->url->link('extension/total/joseanmatias_desconto_boleto', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true);

        if (isset($this->request->post['joseanmatias_desconto_boleto_value'])) {
            $data['joseanmatias_desconto_boleto_value'] = $this->request->post['joseanmatias_desconto_boleto_value'];
        } else {
            $data['joseanmatias_desconto_boleto_value'] = $this->config->get('joseanmatias_desconto_boleto_value');
        }

        if (isset($this->request->post['joseanmatias_desconto_boleto_method'])) {
            $data['joseanmatias_desconto_boleto_method'] = $this->request->post['joseanmatias_desconto_boleto_method'];
        } elseif ($this->config->has('joseanmatias_desconto_boleto_method')) {
            $data['joseanmatias_desconto_boleto_method'] = $this->config->get('joseanmatias_desconto_boleto_method');
        } else {
            $data['joseanmatias_desconto_boleto_method'] = array();
        }

        if (isset($this->request->post['joseanmatias_desconto_boleto_text_list'])) {
            $data['joseanmatias_desconto_boleto_text_list'] = $this->request->post['joseanmatias_desconto_boleto_text_list'];
        } elseif ($this->config->has('joseanmatias_desconto_boleto_text_list')) {
            $data['joseanmatias_desconto_boleto_text_list'] = $this->config->get('joseanmatias_desconto_boleto_text_list');
        } else {
            $data['joseanmatias_desconto_boleto_text_list'] = $this->language->get('desconto_boleto_text_list_default');
        }

        if (isset($this->request->post['joseanmatias_desconto_boleto_text_page'])) {
            $data['joseanmatias_desconto_boleto_text_page'] = $this->request->post['joseanmatias_desconto_boleto_text_page'];
        } elseif ($this->config->has('joseanmatias_desconto_boleto_text_page')) {
            $data['joseanmatias_desconto_boleto_text_page'] = $this->config->get('joseanmatias_desconto_boleto_text_page');
        } else {
            $data['joseanmatias_desconto_boleto_text_page'] = $this->language->get('desconto_boleto_text_page_default');
        }

        if (isset($this->request->post['joseanmatias_desconto_boleto_price_update'])) {
            $data['joseanmatias_desconto_boleto_price_update'] = $this->request->post['joseanmatias_desconto_boleto_price_update'];
        } else {
            $data['joseanmatias_desconto_boleto_price_update'] = $this->config->get('joseanmatias_desconto_boleto_price_update');
        }

        if (isset($this->request->post['joseanmatias_desconto_boleto_outofstock'])) {
            $data['joseanmatias_desconto_boleto_outofstock'] = $this->request->post['joseanmatias_desconto_boleto_outofstock'];
        } else {
            $data['joseanmatias_desconto_boleto_outofstock'] = $this->config->get('joseanmatias_desconto_boleto_outofstock');
        }

        if (isset($this->request->post['joseanmatias_desconto_boleto_status'])) {
            $data['joseanmatias_desconto_boleto_status'] = $this->request->post['joseanmatias_desconto_boleto_status'];
        } else {
            $data['joseanmatias_desconto_boleto_status'] = $this->config->get('joseanmatias_desconto_boleto_status');
        }

        if (isset($this->request->post['joseanmatias_desconto_boleto_sort_order'])) {
            $data['joseanmatias_desconto_boleto_sort_order'] = $this->request->post['joseanmatias_desconto_boleto_sort_order'];
        } else {
            $data['joseanmatias_desconto_boleto_sort_order'] = $this->config->get('joseanmatias_desconto_boleto_sort_order');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/total/joseanmatias_desconto_boleto', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/total/joseanmatias_desconto_boleto')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (empty($this->request->post['joseanmatias_desconto_boleto_value'])) {
            $this->error['desconto_boleto_value'] = $this->language->get('error_value');
        }

        return !$this->error;
    }

}
?>