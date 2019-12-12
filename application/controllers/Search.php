<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	
	public function index() {
		if(isset($_SESSION['id'])) {
			$data['receivedSolicitations'] = friends_model::get_unnacepted_solicitation($_SESSION['id']);
			if($data['receivedSolicitations']) {
				foreach($data['receivedSolicitations'] as $solicitation) {
					$solicitation->user1 = user_model::get_from_id($solicitation->user1);
				}
			}
			$data = $this->load->view('solicitations', $data, TRUE);
			$this->load->view('navbar');
			$this->load->view('search');
		} 
		else { echo 'Por favor faça seu login'; }
	}

	public function user_filter() {
		$data['usersArray'] = user_model::search_all_columns($_POST['search']);

		if(sizeof($data['usersArray']) > 0) {
			foreach($data['usersArray'] as $user) {
				$friends = friends_model::get_friends($user->id);
				if($friends) $user->friends = sizeof($friends);
				else $user->friends = 0;
				$checkins = checkin_model::get_all_from_user($user->id);
				if($checkins)  $user->checkins = sizeof($checkins);
				else $user->checkins = 0;
			}
		}
		$data = $this->load->view('userResults', $data, TRUE);
		echo $data;
	}

	public function beer_filter() {
		
		$data['beersArray'] = beer_model::search_all_columns($_POST['search']);

		if(sizeof($data['beersArray']) > 0) {
			foreach($data['beersArray'] as $beer) {
				$checkins = checkin_model::get_all_from_beer($beer->id);
				$rating = 0;
				if($checkins) foreach($checkins as $checkin) { $rating += $checkin->rating; }
				$rating = $rating/sizeof($checkins);
				$beer->checkins = sizeof($checkins);
				$beer->rating = round($rating, 2);
			}
		}
		$data = $this->load->view('beersResult', $data, TRUE);
		echo $data;
	}

	public function pub_filter() {
		$data['pubsArray'] = pub_model::search_all_columns($_POST['search']);

		if(sizeof($data['pubsArray']) > 0) {
			foreach($data['pubsArray'] as $pub) {
				$checkins = checkin_model::get_all_from_pub($pub->id);
				// Devia ter feito proccedure... maldita preguiça
				// Criar Array de cervejas do pub
				$beersFromPub = array();
				if($checkins) {

					$pub->checkins = sizeof($checkins);

					// Verifico todos os checkins referentes do pub
					foreach($checkins as $checkin) {
						$shouldInsert = true;
						// Verifico se o array de cervejas possui algum valor
						if(sizeof($beersFromPub) > 0 ) 
							// Se possuir vou andar por ele e marcar a variavel should insert como
							// False se essse elemento jáa existir no array
							foreach($beersFromPub as $beer)
								if($beer->id == $checkin->beerId) $shouldIsert = false;
						// Se a variavél for verdadeira o elemento é adicionado no array
						if($shouldInsert) array_push($beersFromPub, beer_model::get_from_id($checkin->beerId));
					}
					//Crio uma variável que irá conter a média geral do pub.
					$pubRating = 0;
					if(sizeof($beersFromPub) > 0) {
						$checkins = checkin_model::get_all_from_beer($beer->id);
						$rating = 0;
						// Verifico a média da cerveja
						if($checkins) foreach($checkins as $checkin) { $rating += $checkin->rating; }
						$rating = $rating/sizeof($rating);
						// Adiciono a média da cerveja a média do pub
						$pubRating += $rating;
					}
					// Divido e showpeta.
					$pubRating = $pubRating/sizeof($beersFromPub);
					$pub->rating = round($pubRating, 2);
				} else {
					$pub->checkins = 0;
					$pub->rating = 0;
				}
			}
		}

		$data = $this->load->view('pubsResult', $data, TRUE);
		echo $data;
	}

	public function checkin_filter() {
		
		$data['checkins'] = checkin_model::search_all_columns($_POST['search']);

		if(sizeof($data['checkins']) > 0) {
			foreach($data['checkins'] as $checkin) {
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
		$data['page'] = true;
		$data = $this->load->view('checkins', $data, TRUE);
		echo $data;
	}
}
