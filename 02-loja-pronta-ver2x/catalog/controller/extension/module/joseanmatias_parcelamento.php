<?php

class ControllerExtensionModuleJoseanMatiasParcelamento extends Controller {

    public function listview($product_info = array()) {
        $data['parcelamento'] = '';
        $data['boleto'] = '';

        $price_to_slice = $this->tax->calculate((isset($product_info['special']) ? $product_info['special'] : $product_info['price']), $product_info['tax_class_id'], $this->config->get('config_tax'));

        if ((float) $price_to_slice > 0) {

            $parcelamento_outofstock = true;

            if (((int) $product_info['quantity'] <= 0 || (int) $product_info['quantity'] < (int) $product_info['minimum']) && !$this->config->get('joseanmatias_parcelamento_outofstock')) {
                $parcelamento_outofstock = false;
            }

            if ($this->config->get('joseanmatias_parcelamento_status') && $parcelamento_outofstock) {
                $data['parcelamento'] = $this->parcelas($price_to_slice, (isset($product_info['product_single']) ? true : false));
            }

            $boleto_outofstock = true;

            if (((int) $product_info['quantity'] <= 0 || (int) $product_info['quantity'] < (int) $product_info['minimum']) && !$this->config->get('joseanmatias_desconto_boleto_outofstock')) {
                $boleto_outofstock = false;
            }

            if ($this->config->get('joseanmatias_desconto_boleto_status') && $boleto_outofstock) {
                $this->load->model('extension/total/joseanmatias_desconto_boleto');
                $data['boleto'] = $this->model_extension_total_joseanmatias_desconto_boleto->discountProductPrice($price_to_slice, isset($product_info['product_single']) ? true : false);
            }
        }

        return $data;
    }

    private function parcelas($parcelamento_price = 0.0, $product_single = false) {
        if ($this->config->get('joseanmatias_parcelamento_status')) {

            $this->load->language('extension/module/joseanmatias_parcelamento');

            $total_parcelas = (int) $this->config->get('joseanmatias_parcelamento_total_parcelas') + 1;
            $valor_minimo = (float) $this->config->get('joseanmatias_parcelamento_valor_minimo');
            $juros = (float) $this->config->get('joseanmatias_parcelamento_juros');
            $total_parcelas_sem_juros = (int) $this->config->get('joseanmatias_parcelamento_parcelas_sem_juros');

            if ($product_single && $this->config->get('joseanmatias_parcelamento_showall')) {
                $showall = true;
            } else {
                $showall = false;
            }

            if ($product_single && $this->config->get('joseanmatias_parcelamento_showtotal')) {
                $showtotal = true;
            } else {
                $showtotal = false;
            }

            if ($product_single) {
                $text_mask = html_entity_decode($this->config->get('joseanmatias_parcelamento_text_page'));
            } else {
                $text_mask = html_entity_decode($this->config->get('joseanmatias_parcelamento_text_list'));
            }

            $parcela_anterior = 0.0;
            $parcelamento_valor_total = '';

            $html = '<div class="parcelamento-list">';
            if ($showall) {
                $html .= '<button class="btn btn-primary btn-block" role="button" data-toggle="collapse" href="#parcelamento" aria-expanded="' . ($this->config->get('joseanmatias_parcelamento_showall_expand') ? 'true' : 'false') . '" aria-controls="parcelamento"><i class="fa fa-credit-card"></i> ' . $this->language->get('text_parcelamento_button') . '</button><div id="parcelamento" class="collapse' . ($this->config->get('joseanmatias_parcelamento_showall_expand') ? ' in' : '') . '"><div class="well">';
            }
            $html .= '<ul>';
            for ($parcela = 1; $parcela <= $total_parcelas; $parcela++) {

                if ($parcela <= $total_parcelas_sem_juros || $juros == 0) {
                    $valor_parcela = $parcelamento_price / $parcela;
                    $text_sufix = $this->language->get('text_tipo_juros_sem');
                } else {
                    if ($this->config->get('joseanmatias_parcelamento_tabela_price')) {
                        $valor_parcela = ($parcelamento_price * ($juros / 100)) / (1 - (1 / (pow(1 + ($juros / 100), $parcela))));
                    } else {
                        $valor_parcela = ($parcelamento_price * pow(1 + ($juros / 100), $parcela)) / $parcela;
                    }
                    $text_sufix = $this->language->get('text_tipo_juros_com');
                }

                if ((($valor_parcela < $valor_minimo && $parcela > 1) || ($parcela == $total_parcelas)) && !$showall) {
                    $valor_real = $this->currency->format($parcela_anterior, $this->session->data['currency']);

                    if ($showtotal) {
                        $parcelamento_valor_total = '<span class="parcelamento-total pull-right">' . $this->language->get('text_parcelamento_total') . '<strong>' . $this->currency->format(($parcela_anterior * ($parcela - 1)), $this->session->data['currency']) . '</strong></span>';
                    }

                    $html .= '<li>' . str_replace(array('[PARCELA]', '[PRECO]', '[TIPO_JUROS]'), array($parcela - 1, $valor_real, $text_sufix), $text_mask) . $parcelamento_valor_total . '</li>';
                    break;
                } elseif ($parcelamento_price < ($valor_minimo * 2)) {
                    $valor_real = $this->currency->format($valor_parcela, $this->session->data['currency']);

                    if ($showtotal) {
                        $parcelamento_valor_total = '<span class="parcelamento-total pull-right">' . $this->language->get('text_parcelamento_total') . '<strong>' . $this->currency->format(($valor_parcela * $parcela), $this->session->data['currency']) . '</strong></span>';
                    }

                    $html .= '<li>' . str_replace(array('[PARCELA]', '[PRECO]', '[TIPO_JUROS]'), array(1, $valor_real, $text_sufix), $text_mask) . $parcelamento_valor_total . '</li>';
                    break;
                } elseif ($showall && ($parcela < $total_parcelas) && ($valor_parcela >= $valor_minimo)) {
                    $valor_real = $this->currency->format($valor_parcela, $this->session->data['currency']);

                    if ($showtotal) {
                        $parcelamento_valor_total = '<span class="parcelamento-total pull-right">' . $this->language->get('text_parcelamento_total') . '<strong>' . $this->currency->format(($valor_parcela * $parcela), $this->session->data['currency']) . '</strong></span>';
                    }

                    $html .= '<li>' . str_replace(array('[PARCELA]', '[PRECO]', '[TIPO_JUROS]'), array($parcela, $valor_real, $text_sufix), $text_mask) . $parcelamento_valor_total . '</li>';
                }

                $parcela_anterior = $valor_parcela;
            }
            $html .= '</ul>';
            if ($showall) {
                if ($juros) {
                    $html .= '<p class="text-muted clearfix"><small class="pull-right">' . str_replace('[JUROS]', $juros, $this->language->get('text_juros_ao_mes')) . '</small></p>';
                }
                $html .= '</div></div>';
            }
            $html .= '</div>';

            return $html;
        }
    }

    public function price_update() {

        $json = array();
        $options_price = 0;

        if (isset($this->request->get['pid'])) {
            $product_id = (int) $this->request->get['pid'];
        } else {
            $product_id = 0;
        }

        if (isset($this->request->post['quantity'])) {
            $quantity = (int) $this->request->post['quantity'];
        } else {
            $quantity = 1;
        }

        $this->language->load('product/product');
        $this->load->model('catalog/product');

        $product_data = $this->model_catalog_product->getProduct($product_id);

        if ($product_data) {
            if (isset($this->request->post['option']) && $this->request->post['option']) {

                $options = $this->model_catalog_product->getProductOptions($product_id);

                foreach ($options as $option) {
                    foreach ($option['product_option_value'] as $option_value) {
                        if (isset($this->request->post['option'][$option['product_option_id']]) && $this->request->post['option'][$option['product_option_id']] == $option_value['product_option_value_id']) {
                            if ($option_value['subtract'] || ($option_value['quantity'] > 0)) {
                                if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float) $option_value['price']) {
                                    $price = $this->tax->calculate($option_value['price'], $product_data['tax_class_id'], $this->config->get('config_tax'));
                                } else {
                                    $price = false;
                                }

                                if ($price) {
                                    if ($option_value['price_prefix'] === '+') {
                                        $options_price = $options_price + (float) $price;
                                    } else {
                                        $options_price = $options_price - (float) $price;
                                    }
                                }
                            }
                        }
                    }
                    unset($price);
                }
            }

            $json['parcelamento'] = '';
            $json['boleto'] = '';

            $product_price = (isset($product_data['special']) ? $product_data['special'] : $product_data['price']);


            $discounts = $this->model_catalog_product->getProductDiscounts($product_id);

            foreach ($discounts as $discount) {
                if ($quantity >= $discount['quantity']) {
                    $product_price = $this->tax->calculate($discount['price'], $product_data['tax_class_id'], $this->config->get('config_tax'));
                }
            }

            $price_to_slice = $this->tax->calculate(($product_price + $options_price) * $quantity, $product_data['tax_class_id'], $this->config->get('config_tax'));

            if ((float) $price_to_slice > 0) {
                if ($this->config->get('joseanmatias_parcelamento_status') && $this->config->get('joseanmatias_parcelamento_price_update')) {
                    $json['parcelamento'] = $this->parcelas($price_to_slice, true);
                }

                if ($this->config->get('joseanmatias_desconto_boleto_status') && $this->config->get('joseanmatias_desconto_boleto_price_update')) {
                    $this->load->model('extension/total/joseanmatias_desconto_boleto');
                    $json['boleto'] = $this->model_extension_total_joseanmatias_desconto_boleto->discountProductPrice($price_to_slice, true);
                }
            }

            $json['success'] = true;
        } else {
            $json['success'] = false;
        }

        $this->response->setOutput(json_encode($json));
    }

}

?>