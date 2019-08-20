<?php

class ControllerExtensionModuleJoseanMatiasParcelamento extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('extension/module/joseanmatias_parcelamento');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            if (empty($this->request->post['joseanmatias_parcelamento_juros'])) {
                $this->request->post['joseanmatias_parcelamento_juros'] = 0;
            }

            if (strstr($this->request->post['joseanmatias_parcelamento_valor_minimo'], ',')) {
                $this->request->post['joseanmatias_parcelamento_valor_minimo'] = str_replace(',', '.', $this->request->post['joseanmatias_parcelamento_valor_minimo']);
            }

            if (strstr($this->request->post['joseanmatias_parcelamento_juros'], ',')) {
                $this->request->post['joseanmatias_parcelamento_juros'] = str_replace(',', '.', $this->request->post['joseanmatias_parcelamento_juros']);
            }

            $this->model_setting_setting->editSetting('joseanmatias_parcelamento', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title_inner');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_image_manager'] = $this->language->get('text_image_manager');
        $data['text_browse'] = $this->language->get('text_browse');
        $data['text_clear'] = $this->language->get('text_clear');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_valor_minimo'] = $this->language->get('entry_valor_minimo');
        $data['entry_juros'] = $this->language->get('entry_juros');
        $data['entry_total_parcelas'] = $this->language->get('entry_total_parcelas');
        $data['entry_parcelas_sem_juros'] = $this->language->get('entry_parcelas_sem_juros');
        $data['entry_text_page'] = $this->language->get('entry_text_page');
        $data['entry_text_list'] = $this->language->get('entry_text_list');
        $data['entry_price_update'] = $this->language->get('entry_price_update');
        $data['entry_tabela_price'] = $this->language->get('entry_tabela_price');
        $data['entry_showtotal'] = $this->language->get('entry_showtotal');
        $data['entry_showall'] = $this->language->get('entry_showall');
        $data['entry_showall_expand'] = $this->language->get('entry_showall_expand');
        $data['entry_outofstock'] = $this->language->get('entry_outofstock');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_inner'),
            'href' => $this->url->link('extension/module/joseanmatias_parcelamento', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/module/joseanmatias_parcelamento', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->error['parcelamento_valor_minimo'])) {
            $data['error_parcelamento_valor_minimo'] = $this->error['parcelamento_valor_minimo'];
        } else {
            $data['error_parcelamento_valor_minimo'] = '';
        }

        if (isset($this->error['parcelamento_total_parcelas'])) {
            $data['error_parcelamento_total_parcelas'] = $this->error['parcelamento_total_parcelas'];
        } else {
            $data['error_parcelamento_total_parcelas'] = '';
        }

        if (isset($this->request->post['joseanmatias_parcelamento_valor_minimo'])) {
            $data['joseanmatias_parcelamento_valor_minimo'] = $this->request->post['joseanmatias_parcelamento_valor_minimo'];
        } else {
            $data['joseanmatias_parcelamento_valor_minimo'] = $this->config->get('joseanmatias_parcelamento_valor_minimo');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_juros'])) {
            $data['joseanmatias_parcelamento_juros'] = $this->request->post['joseanmatias_parcelamento_juros'];
        } else {
            $data['joseanmatias_parcelamento_juros'] = $this->config->get('joseanmatias_parcelamento_juros');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_total_parcelas'])) {
            $data['joseanmatias_parcelamento_total_parcelas'] = $this->request->post['joseanmatias_parcelamento_total_parcelas'];
        } else {
            $data['joseanmatias_parcelamento_total_parcelas'] = $this->config->get('joseanmatias_parcelamento_total_parcelas');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_parcelas_sem_juros'])) {
            $data['joseanmatias_parcelamento_parcelas_sem_juros'] = $this->request->post['joseanmatias_parcelamento_parcelas_sem_juros'];
        } else {
            $data['joseanmatias_parcelamento_parcelas_sem_juros'] = $this->config->get('joseanmatias_parcelamento_parcelas_sem_juros');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_text_list'])) {
            $data['joseanmatias_parcelamento_text_list'] = $this->request->post['joseanmatias_parcelamento_text_list'];
        } elseif ($this->config->get('joseanmatias_parcelamento_text_list')) {
            $data['joseanmatias_parcelamento_text_list'] = $this->config->get('joseanmatias_parcelamento_text_list');
        } else {
            $data['joseanmatias_parcelamento_text_list'] = $this->language->get('parcelamento_text_list_default');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_text_page'])) {
            $data['joseanmatias_parcelamento_text_page'] = $this->request->post['joseanmatias_parcelamento_text_page'];
        } elseif ($this->config->get('joseanmatias_parcelamento_text_page')) {
            $data['joseanmatias_parcelamento_text_page'] = $this->config->get('joseanmatias_parcelamento_text_page');
        } else {
            $data['joseanmatias_parcelamento_text_page'] = $this->language->get('parcelamento_text_page_default');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_price_update'])) {
            $data['joseanmatias_parcelamento_price_update'] = $this->request->post['joseanmatias_parcelamento_price_update'];
        } else {
            $data['joseanmatias_parcelamento_price_update'] = $this->config->get('joseanmatias_parcelamento_price_update');
        }
        
        if (isset($this->request->post['joseanmatias_parcelamento_tabela_price'])) {
            $data['joseanmatias_parcelamento_tabela_price'] = $this->request->post['joseanmatias_parcelamento_tabela_price'];
        } else {
            $data['joseanmatias_parcelamento_tabela_price'] = $this->config->get('joseanmatias_parcelamento_tabela_price');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_showtotal'])) {
            $data['joseanmatias_parcelamento_showtotal'] = $this->request->post['joseanmatias_parcelamento_showtotal'];
        } else {
            $data['joseanmatias_parcelamento_showtotal'] = $this->config->get('joseanmatias_parcelamento_showtotal');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_showall'])) {
            $data['joseanmatias_parcelamento_showall'] = $this->request->post['joseanmatias_parcelamento_showall'];
        } else {
            $data['joseanmatias_parcelamento_showall'] = $this->config->get('joseanmatias_parcelamento_showall');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_showall_expand'])) {
            $data['joseanmatias_parcelamento_showall_expand'] = $this->request->post['joseanmatias_parcelamento_showall_expand'];
        } else {
            $data['joseanmatias_parcelamento_showall_expand'] = $this->config->get('joseanmatias_parcelamento_showall_expand');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_outofstock'])) {
            $data['joseanmatias_parcelamento_outofstock'] = $this->request->post['joseanmatias_parcelamento_outofstock'];
        } else {
            $data['joseanmatias_parcelamento_outofstock'] = $this->config->get('joseanmatias_parcelamento_outofstock');
        }

        if (isset($this->request->post['joseanmatias_parcelamento_status'])) {
            $data['joseanmatias_parcelamento_status'] = $this->request->post['joseanmatias_parcelamento_status'];
        } else {
            $data['joseanmatias_parcelamento_status'] = $this->config->get('joseanmatias_parcelamento_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/joseanmatias_parcelamento', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/joseanmatias_parcelamento')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (empty($this->request->post['joseanmatias_parcelamento_valor_minimo'])) {
            $this->error['parcelamento_valor_minimo'] = $this->language->get('error_parcelamento_valor_minimo');
        }

        if (empty($this->request->post['joseanmatias_parcelamento_total_parcelas'])) {
            $this->error['parcelamento_total_parcelas'] = $this->language->get('error_parcelamento_total_parcelas');
        }

        return !$this->error;
    }
}
?>