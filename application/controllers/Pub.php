<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pub extends CI_Controller {
	public function index() {
		$this->load->view('profile');
	}

	public function save() {
		$pub = new pub_model();
        $pub->name = $_POST['name'];
        $pub->type = $_POST['type'];
        $pub->city = $_POST['city'];
        $pub->state = $_POST['state'];
        $pub->country = $_POST['country'];

        $data = array();
        $pub = $pub->save();
        if ($pub) {
            $data['response'] = 'true';
            $data['pub'] = $pub;
            echo json_encode($data, true);
        } else {
            $data['response'] = false;
            echo json_encode($data, true);
        }
		
    }
    
    public function pubData() {
        $pub = pub_model::get_from_id($_POST['pub']);
        echo json_encode($pub);
    }
}
