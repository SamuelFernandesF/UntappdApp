<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends CI_Controller {
	public function index() {
		$this->load->view('profile');
	}

	public function save() {
		$checkin = new Checkin_model();
        $checkin->pubId = $_POST['pubId'];
        $checkin->beerId = $_POST['beerId'];
        $checkin->comment = $_POST['comment'];
		$checkin->rating = $_POST['rating'];
		$checkin->userId = $_POST['userId'];
		$data['response'] = ($checkin->save()) ? 'true' : 'false';
		echo json_encode($data);
    }


}
