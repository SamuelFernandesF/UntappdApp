<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beer extends CI_Controller {
    public function index() {}
        
    public function profile($id) {
        $data['beer'] = beer_model::get_from_id($id);
        if($data['beer']){
            
            $data['receivedSolicitations'] = friends_model::get_unnacepted_solicitation($_SESSION['id']);
			if($data['receivedSolicitations']) {
				foreach($data['receivedSolicitations'] as $solicitation) {
					$solicitation->user1 = user_model::get_from_id($solicitation->user1);
				}
			}
			
            $data = $this->load->view('solicitations', $data, TRUE);
            
            $this->load->view('navbar');
            $this->load->view('beerProfile', $data);
        }
        else echo 'Essa cerveja não existe';
    }

    public function load_users($id) {
        $checkins = checkin_model::get_all_from_beer($id);
        $usersArray = array();
        $data['userFriends'] = new stdClass();
        if($checkins) {
            foreach($checkins as $checkin) {
                $shouldInsert = true;
                if(sizeof($usersArray) > 0) {
                    foreach($usersArray as $user) {
                        if($user->id === $checkin->userId) $shouldInsert = false;
                    }
                }
                if($shouldInsert) array_push($usersArray, user_model::get_from_id($checkin->userId));
            }
        }
        $data['userFriends'] = $usersArray;
        $data = $this->load->view('friends', $data, TRUE);
		echo $data;
    }

    public function get_checkins($id) {
		$inf['checkins'] = checkin_model::get_all_from_beer($id);
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

    public function get_beer_data($id) {
        $beer = beer_model::get_from_id($id);

		if($beer) {
            $checkins = checkin_model::get_all_from_beer($beer->id);

            $uniqueCheckins = 0;
            $usersArray = array();

            foreach($checkins as $checkin) {
                $shouldInsert = true;
                foreach($usersArray as $user) {
                    if($user == $checkin->userId) $shouldInsert = false;
                }
                if($shouldInsert) {
                    $uniqueCheckins++;
                    array_push($usersArray, $checkin->userId);
                }
            }
            
            $rating = 0;
            if($checkins) foreach($checkins as $checkin) { $rating += $checkin->rating; }
            $rating = $rating/sizeof($checkins);

            $beer->checkinCount = sizeof($checkins);
            $beer->uniqueCheckins = $uniqueCheckins;
            $beer->rating = round($rating, 2);
            $beer->checkins = $checkins;
        }
        echo json_encode($beer);

    }

	public function save() {
		$beer = new Beer_model();
        $beer->name = $_POST['name'];
        $beer->type = $_POST['type'];
        $beer->alcoholicStrength = $_POST['alcoholicStrength'];
        $data = array();
        $beer = $beer->save();
        if ($beer) {
            $data['response'] = 'true';
            $data['beer'] = $beer;
            echo json_encode($data, true);
        } else {
            $data['response'] = false;
            echo json_encode($data, true);
        } 
    }
    
    public function beerData() {
        $beer = Beer_model::get_from_id($_POST['beer']);
        echo json_encode($beer);
    }
}
