<?php

class ModelExtensionShippingR2SFaixaCEPPeso extends Model {

    public function addFaixaCEP($data = array()) {

        $this->db->query("INSERT INTO `" . DB_PREFIX . "r2s_faixa_cep_peso` SET weight_min = '" . (float) $data['weight_min'] . "', weight_max = '" . (float) $data['weight_max'] . "', postcode_min = '" . (int) preg_replace("/[^0-9]/", '', $data['postcode_min']) . "', postcode_max = '" . (int) preg_replace("/[^0-9]/", '', $data['postcode_max']) . "', `cost` = '" . (float) $data['cost'] . "'");

        $faixa_cep_id = $this->db->getLastId();

        foreach ($data['description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "r2s_faixa_cep_peso_description SET faixa_cep_id = '" . (int) $faixa_cep_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "'");
        }
    }

    public function editFaixaCEP($faixa_cep_id, $data = array()) {

        $this->db->query("UPDATE `" . DB_PREFIX . "r2s_faixa_cep_peso` SET weight_min = '" . (float) $data['weight_min'] . "', weight_max = '" . (float) $data['weight_max'] . "', postcode_min = '" . (int) preg_replace("/[^0-9]/", '', $data['postcode_min']) . "', postcode_max = '" . (int) preg_replace("/[^0-9]/", '', $data['postcode_max']) . "', `cost` = '" . (float) $data['cost'] . "' WHERE faixa_cep_id = '" . (int) $faixa_cep_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "r2s_faixa_cep_peso_description WHERE faixa_cep_id = '" . (int) $faixa_cep_id . "'");

        foreach ($data['description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "r2s_faixa_cep_peso_description SET faixa_cep_id = '" . (int) $faixa_cep_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "'");
        }
    }

    public function deleteFaixaCEP($faixa_cep_id) {

        $this->db->query("DELETE FROM `" . DB_PREFIX . "r2s_faixa_cep_peso` WHERE faixa_cep_id = '" . (int) $faixa_cep_id . "'");
    }

    public function copyFaixaCEP($faixa_cep_id) {
        $data = $this->getFaixaCEP($faixa_cep_id);

        if ($data) {

            $data['description'] = $this->getFaixaCEPDescription($faixa_cep_id);

            $this->addFaixaCEP($data);
        }
    }

    public function getFaixaCEP($faixa_cep_id) {

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "r2s_faixa_cep_peso` WHERE faixa_cep_id = '" . (int) $faixa_cep_id . "'");

        return $query->row;
    }

    public function getFaixaCEPDescription($faixa_cep_id) {
        $option_data = array();

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "r2s_faixa_cep_peso_description` WHERE faixa_cep_id = '" . (int) $faixa_cep_id . "'");

        foreach ($query->rows as $result) {
            $option_data[$result['language_id']] = array('title' => $result['title']);
        }

        return $option_data;
    }

    public function getFaixasCEP($data) {

        $sql = "SELECT t1.*, t2.title FROM `" . DB_PREFIX . "r2s_faixa_cep_peso` t1 LEFT JOIN `" . DB_PREFIX . "r2s_faixa_cep_peso_description` t2 ON(t1.faixa_cep_id = t2.faixa_cep_id) WHERE t2.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        $sort_data = array(
            't2.title',
            't1.weight_min',
            't1.postcode_min',
            't1.cost'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY t1.faixa_cep_id";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalFaixasCEP() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "r2s_faixa_cep_peso`");

        if (isset($query->row['total'])) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

    public function createTable() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "r2s_faixa_cep_peso` (
              `faixa_cep_id` int(11) NOT NULL AUTO_INCREMENT,
              `title` varchar(150) NOT NULL,
              `weight_min` float NOT NULL,
              `weight_max` float NOT NULL,
              `postcode_min` int(11) NOT NULL,
              `postcode_max` int(11) NOT NULL,
              `cost` float NOT NULL,
              PRIMARY KEY (`faixa_cep_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "r2s_faixa_cep_peso_description` (
              `faixa_cep_id` int(11) NOT NULL,
              `language_id` int(11) NOT NULL,
              `title` varchar(150) NOT NULL
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
    }

    public function dropTable() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "r2s_faixa_cep_peso`;");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "r2s_faixa_cep_peso_description`;");
    }

}
?>