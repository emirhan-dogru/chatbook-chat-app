<?php

class Homepage extends CI_Controller
{


	public function __construct()
	{

		parent::__construct();
		$this->viewFolder = 'homepage_v';
		$this->imageFolder = 'users_v';

		if (!get_status_user()) {
			redirect(base_url("login"));
			die();
		}

		$this->load->model("friend_model");
		$this->load->model("chat_model");

		date_default_timezone_set('Europe/Istanbul');
	}

	public function index()
	{
		$viewData = new stdClass();
		$viewData->imageFolder = $this->imageFolder;
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = 'dashboard/home';


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function delete_ActiveChat($user_id = 0, $friend_id = 0)
	{

		$this->friend_model->update(
			array(
				'user_id' => $user_id,
				'friend_id' => $friend_id
			),
			array(
				'chatActive' => 0
			)
		);
		redirect(base_url());
		die();
	}

	public function chat($friend_id = 0)
	{
		$user = get_status_user();

		if ($friend_id === $user->id or $friend_id === $user->user_name)
		{
			redirect(base_url());
			die();
		}
		else
		{
			if (!get_isUserid($friend_id))
			{
				if (!isUsername($friend_id)) 
				{
					redirect(base_url());
					die();
				}
				else
				{
					$friend_id = convertUsernameToid($friend_id);
				}
			}





			$friend = $this->friend_model->get(
				array(
					'user_id' => $user->id,
					'friend_id' => $friend_id
				)
			);

			if (!$friend) {
				redirect(base_url());
				die();
			} 
			
			if ($friend->chatActive !== '1') {

				$update = $this->friend_model->update(
					array(
						'user_id' => $user->id,
						'friend_id' => $friend_id
					),
					array(
						'chatActive' => 1
					)
				);
			}

			$items = $this->friend_model->get_all(
				array(
					'user_id' => $user->id,
					'isActive' => 1,
					'chatActive' => 1
				)
			);





			$viewData = new stdClass();
			$viewData->imageFolder = $this->imageFolder;
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = 'dashboard/chat';
			$viewData->items = $items;
			/*$viewData->messages = $Messages;*/
			$viewData->friend_id = $friend_id;


			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}
	}


	public function chat_Send($friend_id = 0)
	{

		$user = get_status_user();

		if ($friend_id === $user->id or $friend_id === $user->user_name)
		{
			redirect(base_url());
			die();
		}
		else
		{
			if (!get_isUserid($friend_id))
			{
				if (!isUsername($friend_id)) 
				{
					redirect(base_url());
					die();
				}
				else
				{
					$friend_id = convertUsernameToid($friend_id);
				}
			}



			$this->load->library("form_validation");
			$this->load->helper("security");

			$this->form_validation->set_rules("message", "Message", "required|trim|xss_clean");

			/*$this->form_validation->set_message(
				array(
					"required" => "<b>{field}</b> field cannot be left blank"
				)
			);*/

			if ($this->form_validation->run() == false) {

				$user = get_status_user();

				$items = $this->friend_model->get_all(
					array(
						'user_id' => $user->id,
						'isActive' => 1,
						'chatActive' => 1
					)
				);


				$viewData = new stdClass();
				$viewData->imageFolder = $this->imageFolder;
				$viewData->viewFolder = $this->viewFolder;
				$viewData->subViewFolder = 'dashboard/chat';
				$viewData->items = $items;
				$viewData->friend_id = $friend_id;

				$alert = array(
					"title" => "Warning",
					"text" => "Blank message cannot be send!",
					"type" => "warning"
				);

				$this->session->set_flashdata('alert', $alert);
				$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
			} else {
				$userinfo = get_status_user();

				$user = $this->chat_model->add(
					array(
						"user_id" => $userinfo->id,
						"friend_id" => $friend_id,
						"message" => $this->input->post("message"),
						"createdAt" => date("Y-m-d H:i:s"),
						"isActive" => 1


					)
				);

				if ($user) {
					$user = get_status_user();

					$items = $this->friend_model->get_all(
						array(
							'user_id' => $user->id,
							'isActive' => 1,
							'chatActive' => 1
						)
					);

					$friend = $this->friend_model->get(
						array(
							'user_id' => $friend_id,
							'friend_id' => $user->id
						)
					);

					if ($friend->chatActive !== '1') {

						$update = $this->friend_model->update(
							array(
								'user_id' => $friend_id,
								'friend_id' => $user->id
							),
							array(
								'chatActive' => 1
							)
						);
					}


					$viewData = new stdClass();
					$viewData->imageFolder = $this->imageFolder;
					$viewData->viewFolder = $this->viewFolder;
					$viewData->subViewFolder = 'dashboard/chat';
					$viewData->items = $items;
					$viewData->friend_id = $friend_id;

					$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
				} else {

					$user = get_status_user();

					$items = $this->friend_model->get_all(
						array(
							'user_id' => $user->id,
							'isActive' => 1,
							'chatActive' => 1
						)
					);


					$Messages = $this->chat_model->get_user_message(
						array(
							'user_id' => $user->id,
							'friend_id' => $friend_id,
							'isActive' => 1
						),
						array(
							'user_id' => $friend_id
						),
						'createdAt ASC'
					);


					$viewData = new stdClass();
					$viewData->imageFolder = $this->imageFolder;
					$viewData->viewFolder = $this->viewFolder;
					$viewData->subViewFolder = 'dashboard/chat';
					$viewData->items = $items;
					$viewData->messages = $Messages;
					$viewData->friend_id = $friend_id;

					$alert = array(
						"title" => "Warning",
						"text" => "An error occurred while sending a blank message!",
						"type" => "warning"
					);

					$this->session->set_flashdata('alert', $alert);
					$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
				}
			}
		}
	}

	public function removeFriend($friend_id = 0) {
		if ($friend_id !== '0') {

			$user = get_status_user();

			$this->friend_model->delete(
				array(
					'user_id' => $user->id,
					'friend_id' => $friend_id
				)
			);

			$this->friend_model->delete(
				array(
					'user_id' => $friend_id,
					'friend_id' => $user->id
				)
			);


			$friends = $this->friend_model->get_all(
				array(
					'user_id' => $user->id
				)
			);

            // left bar arkadaşları listele
			$items = $this->friend_model->get_all(
				array(
					'user_id' => $user->id,
					'isActive' => 1,
					'chatActive' => 1
				)
			);

			$viewData = new stdClass();
			$viewData->imageFolder = $this->imageFolder;
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "dashboard/friends/";
			$viewData->friends = $friends;
			$viewData->items = $items;


			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

		}
	}


	public function addFriend() {
		$user = get_status_user();

		$friend_id = $_GET['uid'];
		$redir = $_GET['redir'];


		$insert = $this->friend_model->add(
			array(
				"user_id" => $user->id,
				"friend_id" => $friend_id,
				"isActive" => 0,
				"chatActive" => 0,
			)
		);

		if ($insert) {
			if ($redir !== '') {
				header("location:$redir");
				die();
			} else {
				redirect(base_url());
				die();
			}
		}
	}

	public function acceptFriend() {
		$user = get_status_user();

		$friend_id = $_GET['uid'];
		$redir = $_GET['redir'];

		$addFriend = $this->friend_model->update(
			array(
				"user_id" => $friend_id,
				"friend_id" => $user->id
			),
			array(
				"isActive" => 1
			)
		);


		$addmyAccount = $this->friend_model->add(
			array(
				"user_id" => $user->id,
				"friend_id" => $friend_id,
				"isActive" => 1,
				"chatActive" => 0
			)
		);

		if ($addFriend && $addmyAccount) {
			if ($redir !== '') {
				header("location:$redir");
				die();
			} else {
				redirect(base_url());
				die();
			}
		}
	}

	public function disallowFriend() {
		$user = get_status_user();

		$friend_id = $_GET['uid'];
		$redir = $_GET['redir'];


		$disallow = $this->friend_model->delete(
			array(
				"user_id" => $friend_id,
				"friend_id" => $user->id
			)
		);

		if ($disallow) {
			if ($redir !== '') {
				header("location:$redir");
				die();
			} else {
				redirect(base_url());
				die();
			}
		}
	}

	public function inviteToCancel() {
		$user = get_status_user();

		$friend_id = $_GET['uid'];
		$redir = $_GET['redir'];


		$disallow = $this->friend_model->delete(
			array(
				"user_id" => $user->id,
				"friend_id" => $friend_id
			)
		);

		if ($disallow) {
			if ($redir !== '') {
				header("location:$redir");
				die();
			} else {
				redirect(base_url());
				die();
			}
		}
	}

	public function refreshMessage($friend_id = 0)
	{
		$user = get_status_user();

		// $items = $this->friend_model->get_all(
		// 	array(
		// 		'user_id' => $user->id,
		// 		'isActive' => 1,
		// 		'chatActive' => 1
		// 	)
		// );

		$viewData = new stdClass();
		$viewData->imageFolder = $this->imageFolder;
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = 'dashboard/chat';
		//$viewData->items = $items;
		$viewData->friend_id = $friend_id;


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/message", $viewData);
	}


	public function refresh_friendsList()
	{
		$user = get_status_user();

		$items = $this->friend_model->get_all(
			array(
				'user_id' => $user->id,
				'isActive' => 1,
				'chatActive' => 1
			)
		);

		$viewData = new stdClass();
		$viewData->viewFolder = 'includes';
		$viewData->subViewFolder = 'friends_list';
		$viewData->items = $items;


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}", $viewData);
	}




}
