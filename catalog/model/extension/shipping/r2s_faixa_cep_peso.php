<?php

class ModelExtensionShippingR2SFaixaCEPPeso extends Model {

    function getQuote($address) {

        $status = false;

        if ($this->config->get('r2s_faixa_cep_peso_status')) {
            $postcode = (int) preg_replace("/[^0-9]/", "", $address['postcode']);

            if (isset($address['product_info']['weight']) && $address['product_info']['weight']) {
                $cart_weight = $this->weight->convert($address['product_info']['weight'], $address['product_info']['weight_class_id'], $this->config->get('config_weight_class_id'));
            } else {
                $cart_weight = $this->cart->getWeight();
            }

            $query = $this->db->query("SELECT t2.title, t1.cost FROM `" . DB_PREFIX . "r2s_faixa_cep_peso` t1 LEFT JOIN `" . DB_PREFIX . "r2s_faixa_cep_peso_description` t2 ON(t1.faixa_cep_id = t2.faixa_cep_id) WHERE (t1.weight_min <= '" . (float) $cart_weight . "' AND t1.weight_max >= '" . (float) $cart_weight . "') AND (t1.postcode_min <= '" . (float) $postcode . "' AND t1.postcode_max >= '" . (float) $postcode . "') AND t2.language_id = '" . (int) $this->config->get('config_language_id') . "' LIMIT 1");

            if ($query->num_rows) {

                $faixa_cep_title = $query->row['title'];
                $faixa_cep_cost = (float) $query->row['cost'];

                $status = true;
            }
        }

        $method_data = array();

        if ($status) {
            $quote_data = array();

            $quote_data['r2s_faixa_cep_peso'] = array(
                'code' => 'r2s_faixa_cep_peso.r2s_faixa_cep_peso',
                'title' => $faixa_cep_title,
                'cost' => $faixa_cep_cost,
                'tax_class_id' => 0,
                'text' => $this->currency->format($faixa_cep_cost, $this->session->data['currency'])
            );

            $method_data = array(
                'code' => 'r2s_faixa_cep_peso',
                'title' => $this->config->get('r2s_faixa_cep_peso_title'),
                'quote' => $quote_data,
                'sort_order' => $this->config->get('r2s_faixa_cep_peso_sort_order'),
                'error' => false
            );
        }

        return $method_data;
    }

}
?>