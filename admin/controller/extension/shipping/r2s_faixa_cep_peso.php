<?php
class ControllerExtensionShippingR2SFaixaCEPPeso extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/shipping/r2s_faixa_cep_peso');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('extension/shipping/r2s_faixa_cep_peso');

        $this->getList();
    }

    public function add() {
        $this->load->language('extension/shipping/r2s_faixa_cep_peso');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('extension/shipping/r2s_faixa_cep_peso');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_extension_shipping_r2s_faixa_cep_peso->addFaixaCEP($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('extension/shipping/r2s_faixa_cep_peso');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('extension/shipping/r2s_faixa_cep_peso');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_extension_shipping_r2s_faixa_cep_peso->editFaixaCEP($this->request->get['faixa_cep_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('extension/shipping/r2s_faixa_cep_peso');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('extension/shipping/r2s_faixa_cep_peso');

        if (isset($this->request->post['selected']) && $this->validatePermission()) {
            foreach ($this->request->post['selected'] as $faixa_cep_id) {
                $this->model_extension_shipping_r2s_faixa_cep_peso->deleteFaixaCEP($faixa_cep_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getList();
    }

    public function copy() {
        $this->load->language('extension/shipping/r2s_faixa_cep_peso');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('extension/shipping/r2s_faixa_cep_peso');

        if (isset($this->request->post['selected']) && $this->validatePermission()) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_extension_shipping_r2s_faixa_cep_peso->copyFaixaCEP($product_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 't2.title';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '&type=shipping';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_inner'),
            'href' => $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['copy'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso/copy', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso/delete', 'token=' . $this->session->data['token'] . $url, true);
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . $url, true);
        $data['config'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso/config', 'token=' . $this->session->data['token'] . $url, true);

        $data['faixas_cep'] = array();

        $filter_data = array(
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $results_total = $this->model_extension_shipping_r2s_faixa_cep_peso->getTotalFaixasCEP();

        $results = $this->model_extension_shipping_r2s_faixa_cep_peso->getFaixasCEP($filter_data);

        foreach ($results as $result) {

            $postcode_min = str_pad($result['postcode_min'], 8, '0', STR_PAD_LEFT);
            $postcode_max = str_pad($result['postcode_max'], 8, '0', STR_PAD_LEFT);

            $data['faixas_cep'][] = array(
                'result_id' => $result['faixa_cep_id'],
                'title' => $result['title'],
                'weights' => sprintf($this->language->get('text_weight_mask'), $result['weight_min'], $result['weight_max']),
                'postcodes' => ($result['postcode_min'] ? sprintf($this->language->get('text_postcode_mask'), $postcode_min, $postcode_max) : $postcode_max),
                'cost' => $this->currency->format($result['cost'], $this->config->get('config_currency')),
                'edit' => $this->url->link('extension/shipping/r2s_faixa_cep_peso/edit', 'token=' . $this->session->data['token'] . '&faixa_cep_id=' . $result['faixa_cep_id'] . $url, true)
            );
        }

        $data['heading_title'] = $this->language->get('heading_title_inner');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_title'] = $this->language->get('column_title');
        $data['column_weights'] = $this->language->get('column_weights');
        $data['column_postcodes'] = $this->language->get('column_postcodes');
        $data['column_cost'] = $this->language->get('column_cost');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_copy'] = $this->language->get('button_copy');
        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_config'] = $this->language->get('button_config');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array) $this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_title'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . '&sort=t2.title' . $url, true);
        $data['sort_weight'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . '&sort=t1.weight_min' . $url, true);
        $data['sort_postcode'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . '&sort=t1.postcode_min' . $url, true);
        $data['sort_cost'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . '&sort=t1.cost' . $url, true);

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $results_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($results_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($results_total - $this->config->get('config_limit_admin'))) ? $results_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $results_total, ceil($results_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/shipping/r2s_faixa_cep_peso_list', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title_inner');

        $data['text_form'] = !isset($this->request->get['option_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_weight'] = $this->language->get('entry_weight');
        $data['entry_postcode'] = $this->language->get('entry_postcode');
        $data['entry_cost'] = $this->language->get('entry_cost');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = array();
        }

        if (isset($this->error['weight'])) {
            $data['error_weight'] = $this->error['weight'];
        } else {
            $data['error_weight'] = array();
        }

        if (isset($this->error['postcode'])) {
            $data['error_postcode'] = $this->error['postcode'];
        } else {
            $data['error_postcode'] = array();
        }

        if (isset($this->error['cost'])) {
            $data['error_cost'] = $this->error['cost'];
        } else {
            $data['error_cost'] = array();
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_inner'),
            'href' => $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url, true)
        );

        if (!isset($this->request->get['faixa_cep_id'])) {
            $data['action'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso/add', 'token=' . $this->session->data['token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso/edit', 'token=' . $this->session->data['token'] . '&faixa_cep_id=' . $this->request->get['faixa_cep_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'] . $url, true);

        if (isset($this->request->get['faixa_cep_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $faixa_cep_info = $this->model_extension_shipping_r2s_faixa_cep_peso->getFaixaCEP($this->request->get['faixa_cep_id']);
        }

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif (!empty($faixa_cep_info)) {
            $data['title'] = $faixa_cep_info['title'];
        } else {
            $data['title'] = '';
        }

        if (isset($this->request->post['description'])) {
            $data['description'] = $this->request->post['description'];
        } elseif (isset($this->request->get['faixa_cep_id'])) {
            $data['description'] = $this->model_extension_shipping_r2s_faixa_cep_peso->getFaixaCEPDescription($this->request->get['faixa_cep_id']);
        } else {
            $data['description'] = array();
        }

        if (isset($this->request->post['weight_min'])) {
            $data['weight_min'] = $this->request->post['weight_min'];
        } elseif (!empty($faixa_cep_info)) {
            $data['weight_min'] = $faixa_cep_info['weight_min'];
        } else {
            $data['weight_min'] = '';
        }

        if (isset($this->request->post['weight_max'])) {
            $data['weight_max'] = $this->request->post['weight_max'];
        } elseif (!empty($faixa_cep_info)) {
            $data['weight_max'] = $faixa_cep_info['weight_max'];
        } else {
            $data['weight_max'] = '';
        }

        if (isset($this->request->post['postcode_min'])) {
            $data['postcode_min'] = $this->request->post['postcode_min'];
        } elseif (!empty($faixa_cep_info)) {
            $data['postcode_min'] = str_pad($faixa_cep_info['postcode_min'], 8, '0', STR_PAD_LEFT);
        } else {
            $data['postcode_min'] = '';
        }

        if (isset($this->request->post['postcode_max'])) {
            $data['postcode_max'] = $this->request->post['postcode_max'];
        } elseif (!empty($faixa_cep_info)) {
            $data['postcode_max'] = str_pad($faixa_cep_info['postcode_max'], 8, '0', STR_PAD_LEFT);
        } else {
            $data['postcode_max'] = '';
        }

        if (isset($this->request->post['cost'])) {
            $data['cost'] = $this->request->post['cost'];
        } elseif (!empty($faixa_cep_info)) {
            $data['cost'] = $faixa_cep_info['cost'];
        } else {
            $data['cost'] = '';
        }

        $data['currency_simbol'] = $this->currency->getSymbolLeft($this->config->get('config_currency'));
        if (!$data['currency_simbol']) {
            $data['currency_simbol'] = $this->currency->getSymbolRight($this->config->get('config_currency'));
        }

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/shipping/r2s_faixa_cep_peso_form', $data));
    }

    public function config() {
        $this->language->load('extension/shipping/r2s_faixa_cep_peso');

        $this->document->setTitle($this->language->get('heading_title_inner'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateConfig()) {

            $this->model_setting_setting->editSetting('r2s_faixa_cep_peso', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'], true));
        }

        $data['heading_title'] = $this->language->get('heading_title_inner');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_title'] = $this->language->get('entry_module_title');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_shipping'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_inner'),
            'href' => $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso/config', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/shipping/r2s_faixa_cep_peso', 'token=' . $this->session->data['token'], true);

        if (isset($this->request->post['r2s_faixa_cep_peso_title'])) {
            $data['r2s_faixa_cep_peso_title'] = $this->request->post['r2s_faixa_cep_peso_title'];
        } else {
            $data['r2s_faixa_cep_peso_title'] = $this->config->get('r2s_faixa_cep_peso_title');
        }

        if (isset($this->request->post['r2s_faixa_cep_peso_status'])) {
            $data['r2s_faixa_cep_peso_status'] = $this->request->post['r2s_faixa_cep_peso_status'];
        } else {
            $data['r2s_faixa_cep_peso_status'] = $this->config->get('r2s_faixa_cep_peso_status');
        }

        if (isset($this->request->post['r2s_faixa_cep_peso_sort_order'])) {
            $data['r2s_faixa_cep_peso_sort_order'] = $this->request->post['r2s_faixa_cep_peso_sort_order'];
        } else {
            $data['r2s_faixa_cep_peso_sort_order'] = $this->config->get('r2s_faixa_cep_peso_sort_order');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/shipping/r2s_faixa_cep_peso_config', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'extension/shipping/r2s_faixa_cep_peso')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (isset($this->request->post['description'])) {
            foreach ($this->request->post['description'] as $language_id => $value) {
                if (empty($value['title'])) {
                    $this->error['title'][$language_id] = $this->language->get('error_title');
                }
            }
        }

        if (empty($this->request->post['weight_max'])) {
            $this->error['weight'] = $this->language->get('error_weight');
        }

        if (empty($this->request->post['postcode_max'])) {
            $this->error['postcode'] = $this->language->get('error_postcode');
        }

        if (empty($this->request->post['cost'])) {
            $this->error['cost'] = $this->language->get('error_cost');
        }

        return !$this->error;
    }

    protected function validatePermission() {
        if (!$this->user->hasPermission('modify', 'extension/shipping/r2s_faixa_cep_peso')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    protected function validateConfig() {
        if (!$this->user->hasPermission('modify', 'extension/shipping/r2s_faixa_cep_peso')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (empty($this->request->post['r2s_faixa_cep_peso_title'])) {
            $this->error['title'] = $this->language->get('error_module_title');
        }

        return !$this->error;
    }

    public function install() {

        $this->load->model('extension/shipping/r2s_faixa_cep_peso');

        $this->model_extension_shipping_r2s_faixa_cep_peso->createTable();
    }

    public function uninstall() {
        $this->load->model('extension/shipping/r2s_faixa_cep_peso');

        $this->model_extension_shipping_r2s_faixa_cep_peso->dropTable();
    }

}
?>