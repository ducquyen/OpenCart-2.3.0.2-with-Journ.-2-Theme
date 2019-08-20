<?php
class ModelExtensionPaymentRedecoin extends Model {
	public function getMethod($address, $total) {
		$this->load->language('extension/payment/redecoin');

		if ($this->config->get('redecoin_total') > 0 && $this->config->get('redecoin_total') > $total) {
			$status = false;
		} else {
			$status = true;
		}
		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'redecoin',
				'title'      => $this->language->get('text_title'),
				'terms'      => '',
				'sort_order' => $this->config->get('redecoin_sort_order')
			);
		}

		return $method_data;
	}


	public function updateOrder($order_id, $redecoin_token) {
		
		$this->db->query( "UPDATE `".DB_PREFIX."order` SET `redecoin_token` = '" . $this->db->escape($redecoin_token) . "' WHERE `order_id`=" . ((int) $order_id));
		
	}

}
