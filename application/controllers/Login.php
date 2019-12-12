<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index() {
		$this->load->view('login');
	}

	private function fetch_data() {
		return user_model::get_all();
	}

	public function login_method() {
		$user = user_model::check_user($_POST['username'], $_POST['password']);
		$data = array();
		if ($user) {
			$this->session->id = $user->id ;
			$this->session->name = $user->name;
			$data['response'] = 'true';
			$data['user'] = $user;
		} else {
			$data['response'] = 'false';
		}
		echo json_encode($data, true);
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}

	public function signup() {
		$user = new user_model();
		
		$user->name = $_POST['username'];
		$user->email = $_POST['email'];
		$user->password = $_POST['password'];
		$user->beer_counter = 0;
		$user->total_beers = 0;
		$user->description = '';
		$user->picture = 'aapsodapicmauenfq12pke221je99912e1d09ckqw0scka0s';

		$data = array();
		$user = $user->saveInsert();
		
        if ($user) {
            $data['response'] = 'true';
			$data['user'] = $user;
			$this->session->id = $user->id ;
			$this->session->name = $user->name;
        } else {
            $data['response'] = 'false';
		}
		echo json_encode($data, true);
	}
}
