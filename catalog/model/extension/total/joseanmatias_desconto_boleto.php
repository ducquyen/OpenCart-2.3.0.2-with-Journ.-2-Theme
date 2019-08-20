<?php

class ModelExtensionTotalJoseanMatiasDescontoBoleto extends Model {

    public function getTotal($total) {

        if (isset($this->session->data['payment_method']) && $this->config->get('joseanmatias_desconto_boleto_status')) {
            $payment_method = $payment_method = $this->session->data['payment_method']['code'];

            if (is_array($this->config->get('joseanmatias_desconto_boleto_method')) && in_array($payment_method, $this->config->get('joseanmatias_desconto_boleto_method'))) {

                $desconto_boleto = $this->discountCalc($total['total']);

                $this->load->language('extension/total/joseanmatias_desconto_boleto');

                $text_title = str_replace(array('[MODULE_NAME]', '[PERCENT]'), array($this->session->data['payment_method']['title'], $this->config->get('joseanmatias_desconto_boleto_value')), $this->language->get('text_title'));

                $total['totals'][] = array(
                    'code'       => 'joseanmatias_desconto_boleto',
                    'title' => $text_title,
                    'value' => - $desconto_boleto,
                    'sort_order' => $this->config->get('joseanmatias_desconto_boleto_sort_order')
                );

                $total['total'] -= $desconto_boleto;
            }
        }
    }

    public function discountCalc($total_value) {

        $desconto_boleto = $total_value * $this->config->get('joseanmatias_desconto_boleto_value') / 100;

        return $desconto_boleto;
    }

    public function discountProductPrice($current_price, $product_single = false) {

        if($product_single) {
            $text_mask = html_entity_decode($this->config->get('joseanmatias_desconto_boleto_text_page'));
        } else {
            $text_mask = html_entity_decode($this->config->get('joseanmatias_desconto_boleto_text_list'));
        }

        if ($this->config->get('joseanmatias_desconto_boleto_status') && $this->config->get('joseanmatias_desconto_boleto_value')) {
            $string_discount_price = str_replace('[PRECO]', $this->currency->format($current_price - $this->discountCalc($current_price), $this->session->data['currency']), $text_mask);
        } else {
            $string_discount_price = '';
        }

        return $string_discount_price;
    }

}

?>