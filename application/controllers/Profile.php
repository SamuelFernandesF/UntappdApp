<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function index() {}

	public function user ($id) {
		$data['user'] = user_model::get_from_id($id);
		$data['beers'] = beer_model::get_all();
		$data['pubs'] = pub_model::get_all();
		if(isset($_SESSION['id'])) {
			if($data['user']) {
				if($_SESSION['id'] != $id) {
					$data['friends'] = friends_model::get_from_users($_SESSION['id'], $id);
				}
				$data['userFriends'] = friends_model::get_friends($id);
				if($data['userFriends']) {
					foreach($data['userFriends'] as $friend) {
						if($friend->user1 === $id) {
							$friend->newFriend = user_model::get_from_id($friend->user2);
						} else {
							$friend->newFriend = user_model::get_from_id($friend->user1);
						}
					}
				}

				$this->load->view('navbar', $data);
				$this->load->view('profile', $data);
				$this->load->view('checkin-form', $data);
			}
			else echo 'Esse usuário não existe';
		} else { echo 'Por favor faça seu login'; }
	}

	public function add_friend($id) {
		$friend = new friends_model();
		$friend->user1 = $_SESSION['id'];
		$friend->user2 = $id;
		$friend->status = 0;
		echo ($friend->save()) ?  json_encode('success') :  json_encode('false');
	}

	public function load_friends($id) {
		$inf['userFriends'] = friends_model::get_friends($id);
		if($inf['userFriends']) {
			foreach($inf['userFriends'] as $friend) {
				if($friend->user1 === $id) {
					$friend->newFriend = user_model::get_from_id($friend->user2);
				} else {
					$friend->newFriend = user_model::get_from_id($friend->user1);
				}
			}
		}
		$data = $this->load->view('friends', $inf, TRUE);
		echo $data;
	}

	public function load_solicitations() {
		$data['receivedSolicitations'] = friends_model::get_unnacepted_solicitation($_SESSION['id']);
		if($data['receivedSolicitations']) {
			foreach($data['receivedSolicitations'] as $solicitation) {
				$solicitation->user1 = user_model::get_from_id($solicitation->user1);
			}
		}
		$data = $this->load->view('solicitations', $data, TRUE);
		echo $data;
	}

	public function confirm_solicitation() {
		$friendSolicitation = friends_model::get_from_users($_SESSION['id'], $_POST['add']);
		$friendSolicitation->status = 1;
		$friendSolicitation->saveUpdate();
		if($_POST['page'] != -1) $this->load_friends($_POST['page']);
	}

	public function get_checkouts($id) {
		$inf['checkins'] = checkin_model::get_all_from_user($id);
		if($inf['checkins']) {
			foreach( $inf['checkins'] as $checkin) {
				$checkin->beerData = beer_model::get_from_id($checkin->beerId);
				$checkin->userData = user_model::get_from_id($checkin->userId);
				$checkin->comments = comments_model::get_all_from_checkin($checkin->id);
				if(isset($checkin->comments[0])) {
					foreach($checkin->comments as $comment) {
						$comment->userData = user_model::get_from_id($comment->userId);
					}
				}
			}
		}
		$inf['user'] = $id;
		$data = $this->load->view('checkins', $inf, TRUE);
		echo $data;
	}	

	public function add_comment() {
		$comment = new comments_model();
		$comment->comment = $_POST['comment'];
		$comment->checkinId = $_POST['checkinId'];
		$comment->userId = $_POST['userId'];
		echo ($comment->save()) ? 'success' : 'error';
	}


	public function update_picture($id) {
		foreach ($_FILES as $value) {
			if(move_uploaded_file($value['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/Untappd/assets/images/'.$value['name'])) {
				$user = new User_model($id);
				$user->picture = 'assets/images/'.$value['name'];
				$data['response'] = ($user->saveUpdate()) ? 'true' : 'false';
				$data['path'] = 'assets/images/'.$value['name'];
				echo json_encode($data);
			}
			else echo ' ERROR SAVING IMAGE';

		}
	}

	public function update_description($id) {
		$user = new User_model($id);
		$user->description = $_POST['userDescription'];
		$data['response'] = ($user->saveUpdate()) ? 'true' : 'false';
		$data['val'] = $user->description;
		echo json_encode($data);
	}


}
