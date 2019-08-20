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
	
	
	
class ControllerCheckoutRegister extends Controller {
	public function index() {
		$this->load->language('checkout/checkout');

		$data['text_checkout_payment_address'] = $this->language->get('text_checkout_payment_address');
		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_your_address'] = $this->language->get('text_your_address');
		$data['text_your_password'] = $this->language->get('text_your_password');
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
		$data['entry_newsletter'] = sprintf($this->language->get('entry_newsletter'), $this->config->get('config_name'));
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_shipping'] = $this->language->get('entry_shipping');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');

		$data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups  as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$data['customer_groups'][] = $customer_group;
				}
			}
		}

		$data['customer_group_id'] = $this->config->get('config_customer_group_id');

		if (isset($this->session->data['shipping_address']['postcode'])) {
			$data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} else {
			$data['postcode'] = '';
		}

		if (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$data['zone_id'] = '';
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields();

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
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

		$data['shipping_required'] = $this->cart->hasShipping();

		$this->response->setOutput($this->load->view('checkout/register', $data));
	}

	public function save() {
		$this->load->language('checkout/checkout');

		$json = array();

		// Validate if customer is already logged out.
		if ($this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', true);
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$json['redirect'] = $this->url->link('checkout/cart');

				break;
			}
		}

		if (!$json) {
			$this->load->model('account/customer');

			if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
				$json['error']['firstname'] = $this->language->get('error_firstname');
			}

			if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
				$json['error']['lastname'] = $this->language->get('error_lastname');
			}

			if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
				$json['error']['email'] = $this->language->get('error_email');
			}

			if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
				$json['error']['warning'] = $this->language->get('error_exists');
			}

			if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
				$json['error']['telephone'] = $this->language->get('error_telephone');
			}

			if ((utf8_strlen(trim($this->request->post['address_1'])) < 3) || (utf8_strlen(trim($this->request->post['address_1'])) > 128)) {
				$json['error']['address_1'] = $this->language->get('error_address_1');
			}

			if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {
				$json['error']['city'] = $this->language->get('error_city');
			}

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

			if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['postcode'])) < 2 || utf8_strlen(trim($this->request->post['postcode'])) > 10)) {
				$json['error']['postcode'] = $this->language->get('error_postcode');
			}

			if ($this->request->post['country_id'] == '') {
				$json['error']['country'] = $this->language->get('error_country');
			}

			if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
				$json['error']['zone'] = $this->language->get('error_zone');
			}

			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$json['error']['password'] = $this->language->get('error_password');
			}

			if ($this->request->post['confirm'] != $this->request->post['password']) {
				$json['error']['confirm'] = $this->language->get('error_confirm');
			}

			if ($this->config->get('config_account_id')) {
				$this->load->model('catalog/information');

				$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

				if ($information_info && !isset($this->request->post['agree'])) {
					$json['error']['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
				}
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

	
		  //validação Opencart Master
	 $ativo_module = $this->config->get('validar_status');
	 $ativo_cpf = $this->config->get('validar_ativo');
	 $ativo_cnpj = $this->config->get('validar_ativo1');
	 $ativo_misto = $this->config->get('validar_ativo2');
	 $val_cpf = $this->config->get('validar_cpf');
	 $val_cnpj = $this->config->get('validar_cnpj');
	 $val_misto = $this->config->get('validar_misto');
	 
	 if (($ativo_cpf)  && (!$ativo_cnpj) && ($ativo_module)){
	  $cpf = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cpf]); 
	
	if ($cpf->valida()) { 
	
	 } else {
	
$json['error']['custom_field' . $val_cpf] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
	 
	 }
	 
	 } elseif (($ativo_cnpj) && (!$ativo_cpf) && ($ativo_module)){
	 $cnpj = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cnpj] ); 
	
	if ($cnpj->valida()) { 
	
	 } else {
	
$json['error']['custom_field' . $val_cnpj] =sprintf($this->language->get('error_custom_field'), $custom_field['name']);
	 
	 }
	 
	 }elseif (($ativo_misto) && ($ativo_module)){
	 $misto = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_misto] ); 
	
	if ($misto->valida()) { 
	
	 } else {
	
$json['error']['custom_field' . $val_misto] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
	 
	 }
	 
	 } elseif (($ativo_cnpj) && ($ativo_cpf) && ($ativo_module)){
	 $cnpj = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cnpj]); 
	 $cpf = new ValidaCPFCNPJ($this->request->post['custom_field']['account'][$val_cpf]); 
	if ( $cpf->valida() && !$cnpj->valida() || !$cpf->valida() && $cnpj->valida()) { 
	 } 
	 else {
	$json['error']['custom_field' . $val_cnpj] =sprintf($this->language->get('error_custom_field'), $custom_field['name']);
	$json['error']['custom_field' . $val_cpf] =sprintf($this->language->get('error_custom_field'), $custom_field['name']);
	 }
	 
	 }
	
	
				if ($custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
					$json['error']['custom_field' . $custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
				} elseif (($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
					$json['error']['custom_field' . $custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
				}
			}

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error']['captcha'] = $captcha;
				}
			}
		}

		if (!$json) {
			$customer_id = $this->model_account_customer->addCustomer($this->request->post);

			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

			$this->session->data['account'] = 'register';

			$this->load->model('account/customer_group');

			$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

			if ($customer_group_info && !$customer_group_info['approval']) {
				$this->customer->login($this->request->post['email'], $this->request->post['password']);

				// Default Payment Address
				$this->load->model('account/address');

				$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());

				if (!empty($this->request->post['shipping_address'])) {
					$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}
			} else {
				$json['redirect'] = $this->url->link('account/success');
			}

			unset($this->session->data['guest']);
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);

			// Add to activity log
			if ($this->config->get('config_customer_activity')) {
				$this->load->model('account/activity');

				$activity_data = array(
					'customer_id' => $customer_id,
					'name'        => $this->request->post['firstname'] . ' ' . $this->request->post['lastname']
				);

				$this->model_account_activity->addActivity('register', $activity_data);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
