<?php


class ValidaCPFCNPJ {
	
	function __construct ( $valor = null ) {
	
		$this->valor = preg_replace( '/[^0-9]/', '', $valor );

		$this->valor = (string)$this->valor;
	}

	
	protected function verifica_cpf_cnpj () {
		
		if ( strlen( $this->valor ) === 11 ) {
			return 'CPF';
		} 
	
		elseif ( strlen( $this->valor ) === 14 ) {
			return 'CNPJ';
		} 
		
		else {
			return false;
		}
	}

	
	protected function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
		
		for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
			
			$soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );

			$posicoes--;
	
			if ( $posicoes < 2 ) {
				// Retorno a posição para 9
				$posicoes = 9;
			}
		}

		$soma_digitos = $soma_digitos % 11;

		if ( $soma_digitos < 2 ) {
		
			$soma_digitos = 0;
		} else {
		
			$soma_digitos = 11 - $soma_digitos;
		}

		$cpf = $digitos . $soma_digitos;

		if ($cpf == "11111111111") {
		return false;
		} elseif ($cpf == "22222222222"){
		return false;
		} elseif ($cpf == "33333333333"){
		return false;
		} elseif ($cpf == "44444444444"){
		return false;
		} elseif ($cpf == "55555555555"){
		return false;
		} elseif ($cpf == "66666666666"){
		return false;
		} elseif ($cpf == "77777777777"){
		return false;
		} elseif ($cpf == "88888888888"){
		return false;
		} elseif ($cpf == "99999999999"){
		return false;
		} elseif ($cpf == "00000000000"){
		return false;
		} else {
		return $cpf;
		}

	}

	protected function valida_cpf() {
		
		$digitos = substr($this->valor, 0, 9);

		$novo_cpf = $this->calc_digitos_posicoes( $digitos );

		$novo_cpf = $this->calc_digitos_posicoes( $novo_cpf, 11 );

		if ( $novo_cpf === $this->valor ) {
			
			return true;
		} else {
			
			return false;
		}
	}

	protected function valida_cnpj () {
		
		$cnpj_original = $this->valor;

		$primeiros_numeros_cnpj = substr( $this->valor, 0, 12 );
	
		$primeiro_calculo = $this->calc_digitos_posicoes( $primeiros_numeros_cnpj, 5 );

		$segundo_calculo = $this->calc_digitos_posicoes( $primeiro_calculo, 6 );

		$cnpj = $segundo_calculo;

		if ( $cnpj === $cnpj_original ) {
			return true;
		}
	}

	public function valida () {
		
		if ( $this->verifica_cpf_cnpj() === 'CPF' ) {
			
			return $this->valida_cpf();
		} 
		
		elseif ( $this->verifica_cpf_cnpj() === 'CNPJ' ) {
			
			return $this->valida_cnpj();
		} 
		
		else {
			return false;
		}
	}
	
	public function formata() {
		
		$formatado = false;

		if ( $this->verifica_cpf_cnpj() === 'CPF' ) {
			
			if ( $this->valida_cpf() ) {
				// Formata o CPF ###.###.###-##
				$formatado  = substr( $this->valor, 0, 3 ) . '.';
				$formatado .= substr( $this->valor, 3, 3 ) . '.';
				$formatado .= substr( $this->valor, 6, 3 ) . '-';
				$formatado .= substr( $this->valor, 9, 2 ) . '';
			}
		} 
		
		elseif ( $this->verifica_cpf_cnpj() === 'CNPJ' ) {
			
			if ( $this->valida_cnpj() ) {
				// Formata o CNPJ ##.###.###/####-##
				$formatado  = substr( $this->valor,  0,  2 ) . '.';
				$formatado .= substr( $this->valor,  2,  3 ) . '.';
				$formatado .= substr( $this->valor,  5,  3 ) . '/';
				$formatado .= substr( $this->valor,  8,  4 ) . '-';
				$formatado .= substr( $this->valor, 12, 14 ) . '';
			}
		} 

		
		return $formatado;
	}
}

	
class ControllerAccountRegister extends Controller {
	private $error = array();

	public function index() {
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$this->load->language('account/register');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$customer_id = $this->model_account_customer->addCustomer($this->request->post);

			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

			$this->customer->login($this->request->post['email'], $this->request->post['password']);

			unset($this->session->data['guest']);

			// Add to activity log
			if ($this->config->get('config_customer_activity')) {
				$this->load->model('account/activity');

				$activity_data = array(
					'customer_id' => $customer_id,
					'name'        => $this->request->post['firstname'] . ' ' . $this->request->post['lastname']
				);

				$this->model_account_activity->addActivity('register', $activity_data);
			}

			$this->response->redirect($this->url->link('account/success'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('account/register', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', true));
		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_your_address'] = $this->language->get('text_your_address');
		$data['text_your_password'] = $this->language->get('text_your_password');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['address_1'])) {
			$data['error_address_1'] = $this->error['address_1'];
		} else {
			$data['error_address_1'] = '';
		}

		if (isset($this->error['city'])) {
			$data['error_city'] = $this->error['city'];
		} else {
			$data['error_city'] = '';
		}

		if (isset($this->error['postcode'])) {
			$data['error_postcode'] = $this->error['postcode'];
		} else {
			$data['error_postcode'] = '';
		}

		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$data['error_custom_field'] = array();
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}

		$data['action'] = $this->url->link('account/register', '', true);

		$data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$data['customer_groups'][] = $customer_group;
				}
			}
		}

		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} else {
			$data['fax'] = '';
		}

		if (isset($this->request->post['company'])) {
			$data['company'] = $this->request->post['company'];
		} else {
			$data['company'] = '';
		}

		if (isset($this->request->post['address_1'])) {
			$data['address_1'] = $this->request->post['address_1'];
		} else {
			$data['address_1'] = '';
		}

		if (isset($this->request->post['address_2'])) {
			$data['address_2'] = $this->request->post['address_2'];
		} else {
			$data['address_2'] = '';
		}

		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} elseif (isset($this->session->data['shipping_address']['postcode'])) {
			$data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} else {
			$data['postcode'] = '';
		}

		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = (int)$this->request->post['country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = (int)$this->request->post['zone_id'];
		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$data['zone_id'] = '';
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields();

		if (isset($this->request->post['custom_field'])) {
			if (isset($this->request->post['custom_field']['account'])) {
				$account_custom_field = $this->request->post['custom_field']['account'];
			} else {
				$account_custom_field = array();
			}

			if (isset($this->request->post['custom_field']['address'])) {
				$address_custom_field = $this->request->post['custom_field']['address'];
			} else {
				$address_custom_field = array();
			}

			$data['register_custom_field'] = $account_custom_field + $address_custom_field;
		} else {
			$data['register_custom_field'] = array();
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}

		if (isset($this->request->post['newsletter'])) {
			$data['newsletter'] = $this->request->post['newsletter'];
		} else {
			$data['newsletter'] = '';
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), true), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/register', $data));
	}

	private function validate() {
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen(trim($this->request->post['address_1'])) < 3) || (utf8_strlen(trim($this->request->post['address_1'])) > 128)) {
			$this->error['address_1'] = $this->language->get('error_address_1');
		}

		if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {
			$this->error['city'] = $this->language->get('error_city');
		}

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['postcode'])) < 2 || utf8_strlen(trim($this->request->post['postcode'])) > 10)) {
			$this->error['postcode'] = $this->language->get('error_postcode');
		}

		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}

		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
			$this->error['zone'] = $this->language->get('error_zone');
		}

		// Customer Group
		if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->post['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		// Custom field validation
		$this->load->model('account/custom_field');

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
            if ($custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			} elseif (($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
            	$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
            }
		}


	
	 //validação Opencart Master
	 $ativo_module = $this->config->get('validar_status');
	 $ativo_cpf = $this->config->get('validar_ativo');
	 $ativo_cnpj = $this->config->get('validar_ativo1');
	 $ativo_misto = $this->config->get('validar_ativo2');
	 $val_cpf = $this->config->get('validar_cpf');
	 $val_cnpj = $this->config->get('validar_cnpj');
	 $val_misto = $this->config->get('validar_misto');
	 
	 if (($ativo_cpf)  && (!$ativo_cnpj) && ($ativo_module)){
	 $cpf = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cpf] ); 
	
	 if ($cpf->valida()) { 
	
	 } else {
	
     $this->error['custom_field'][$val_cpf] = "Atenção: o campo CPF está Inválido!";
	 
	 }
	 
	 } elseif (($ativo_cnpj) && (!$ativo_cpf) && ($ativo_module)) {
	 $cnpj = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cnpj] ); 
	
	if ($cnpj->valida()) { 
	
	 } else {
	
     $this->error['custom_field'][$val_cnpj] = "Atenção: o campo CNPJ está Inválido!";
	 
	 }
	 
	 }elseif (($ativo_misto) && ($ativo_module)) {
	 $misto = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_misto] ); 
	
	if ($misto->valida()) { 
	
	 } else {
	
     $this->error['custom_field'][$val_misto] = "Atenção: o campo CPF / CNPJ  está Inválido!";
	 
	 }
	 
	 }  elseif (($ativo_cnpj) && ($ativo_cpf) && ($ativo_module)) {
	 $cnpj = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cnpj] ); 
	 $cpf  = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cpf] ); 
	 if ( $cpf->valida() && !$cnpj->valida()) { 
	 } elseif ( !$cpf->valida() && $cnpj->valida()) { 
	
	 } else {
	 $this->error['custom_field'][$val_cnpj] = "Atenção: o campo CNPJ está Inválido!";
	 $this->error['custom_field'][$val_cpf] = "Atenção: o campo CPF está Inválido!";
	 }
	 
	 }
	
		
	
		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		// Agree to terms
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}

		return !$this->error;
	}


					public function estado_autocompletar() {
						$this->load->model('localisation/zone');
						$code = $this->model_localisation_zone->getZonesByEstado($this->request->get['estado']);
						if ($code != '') {
							$output = $code;
						}else{
							$output = '';
						}
						$this->response->setOutput($output);
					}
				
	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}