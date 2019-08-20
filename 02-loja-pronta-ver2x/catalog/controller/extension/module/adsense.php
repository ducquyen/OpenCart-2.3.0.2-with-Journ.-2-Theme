<?php
class ControllerExtensionModuleAdsense extends Controller {
	public function index($setting) {

        $data['adsense'] = html_entity_decode($setting['script'], ENT_QUOTES, 'UTF-8');

        return $this->load->view('extension/module/adsense', $data);

	}
}