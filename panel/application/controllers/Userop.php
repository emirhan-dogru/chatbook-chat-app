<?php

class Userop extends CI_Controller
{


	public function __construct()
	{

		parent::__construct();
		$this->viewFolder = 'homepage_v';
		$this->imageFolder = 'users_v';

		$this->load->model("user_model");
	}

	public function login()
	{
		$phone = $this->session->userdata("phone");

		if ($phone) {
			redirect(base_url('login/confirm'));
			die();
		} else {
			if (get_status_user()) {
				redirect(base_url());
				die();
			}
		}



		$viewData = new stdClass();
		$viewData->imageFolder = $this->imageFolder;
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = 'login';


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function do_Phone()
	{
		$phone = convertToPhone($this->input->post("phone"));

		if (strlen($phone) < 10) {
			$alert = array(
				"title" => "Error",
				"text" => "Please enter a valid phone number",
				"type" => "error"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("login"));
			die();
		}

		
		if (get_status_user()) {
			redirect(base_url());
			die();
		}

		$this->load->library("form_validation");
		$this->load->helper("security");

		$this->form_validation->set_rules("phone", "Phone number", "required|trim|xss_clean");

		/*$this->form_validation->set_message(
			array(
				"required" => "<b>{field}</b> field cannot be left blank"
			)
		);*/

		if ($this->form_validation->run() == false) {

			$viewData = new stdClass();
			$viewData->imageFolder = $this->imageFolder;
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "login";
			$viewData->form_error = true;


			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		} else {
			$user = $this->user_model->get(
				array(
					"phone" => $phone
				)
			);

			if ($user) {

				$this->session->set_userdata("phone", $user->phone);
				redirect(base_url('login/confirm'));
				die();
			} else {

				$alert = array(
					"title" => "Login Failed",
					"text" => "Phone number not found!",
					"type" => "error"
				);

				$this->session->set_flashdata('alert', $alert);
				redirect(base_url("login"));
				die();
			}
		}
	}

	public function confirm_login()
	{
		$phone = $this->session->userdata("phone");

		if (!$phone) {
			if (get_status_user()) {
				redirect(base_url());
				die();
			} else {
				redirect(base_url('login'));
				die();
			}
		}


		$viewData = new stdClass();
		$viewData->imageFolder = $this->imageFolder;
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = 'confirm/login';


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function do_Password()
	{
		if (get_status_user()) {
			redirect(base_url());
			die();
		}


		$this->load->library("form_validation");
		$this->load->helper("security");


		$this->form_validation->set_rules("password", "Password", "required|trim|xss_clean");

		/*$this->form_validation->set_message(
			array(
				"required" => "<b>{field}</b> alanı boş bırakılamaz"
			)
		);*/

		if ($this->form_validation->run() == false) {

			$viewData = new stdClass();
			$viewData->imageFolder = $this->imageFolder;
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "confirm/login";
			$viewData->form_error = true;


			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		} else {
			$user = $this->user_model->get(
				array(
					"phone" => $this->session->userdata("phone"),
					"password" => md5($this->input->post("password"))
				)
			);

			if ($user) {

				$alert = array(
					"title" => "Sucsess",
					"text" => "$user->full_name Welcome Again",
					"type" => "success"
				);

				$this->session->unset_userdata("phone");
				$this->session->set_userdata("user", $user);
				$this->session->set_flashdata('alert', $alert);
				redirect(base_url());
			} else {

				$alert = array(
					"title" => "Error",
					"text" => "Your password is incorrect!",
					"type" => "error"
				);

				$this->session->set_flashdata('alert', $alert);
				redirect(base_url("login/confirm"));
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata("user");
		redirect(base_url("login"));
		die();
	}

	public function register()
	{
		$isphone = $this->session->userdata("isphone");

		if ($isphone) {
			redirect(base_url('register/confirm'));
			die();
		} else {
			if (get_status_user()) {
				redirect(base_url());
				die();
			}
		}



		$viewData = new stdClass();
		$viewData->imageFolder = $this->imageFolder;
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = 'register';


		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function isPhone()
	{
		$phone = convertToPhone($this->input->post("phone"));

		if (strlen($phone) < 10) {
			$alert = array(
				"title" => "Error",
				"text" => "Please enter a valid phone number",
				"type" => "error"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("register"));
			die();
		}

		if (get_status_user()) {
			redirect(base_url());
			die();
		}

		$isnumber = $this->user_model->get(
			array(
				"phone" => $phone
			)
		);

		if ($isnumber) {
			$alert = array(
				"title" => "Error",
				"text" => "Your entered <b>phone number</b> previously recorded",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("register"));
			die();
		}

		$this->load->library("form_validation");
		$this->load->helper("security");

		$this->form_validation->set_rules("phone", "Phone number", "required|trim|xss_clean");

		/*$this->form_validation->set_message(
			array(
				"required" => "<b>{field}</b> field cannot be left blank"
			)
		);*/

		if ($this->form_validation->run() == false) {

			$viewData = new stdClass();
			$viewData->imageFolder = $this->imageFolder;
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "register";
			$viewData->form_error = true;


			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		} else {
			$this->session->set_userdata("isphone", $this->input->post('phone'));
			redirect(base_url('register/confirm'));
			die();
		}
	}

	public function confirm_register()
	{
		$isphone = $this->session->userdata("isphone");

		if (!$isphone) {
			if (get_status_user()) {
				redirect(base_url());
				die();
			} else {
				redirect(base_url('register'));
				die();
			}
		}

		$viewData = new stdClass();
		$viewData->imageFolder = $this->imageFolder;
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = 'confirm/register';

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function do_register()
	{

		$this->load->library("form_validation");
		$this->load->helper("security");

		$this->form_validation->set_rules("full_name", "Name surname", "required|trim|xss_clean");
		$this->form_validation->set_rules("email", "Mail Address", "required|trim|valid_email|is_unique[users.email]|xss_clean");
		$this->form_validation->set_rules("password", "Password", "required|trim|min_length[6]|max_length[15]|xss_clean");
		$this->form_validation->set_rules("re_password", "Confirm Password", "required|trim|min_length[6]|max_length[15]|matches[password]|xss_clean");
		$this->form_validation->set_rules("accept_terms_checkbox", "License agreement", "required|trim|xss_clean");

		/*$this->form_validation->set_message(
			array(
				"required" => "{field} field cannot be left blank",
				"valid_email" => "Please enter a valid e-mail address",
				"is_unique" => "<b>{field}</b> previously recorded",
				"matches" => "Passwords do not match",
				"min_length" => "Your password must be at least 6 characters long",
				"max_length" => "Your password must be up to 15 characters long"
			)
		);*/

		$validate = $this->form_validation->run();

		if ($validate) {

			$user_id = sha1(uniqid());

			$insert = $this->user_model->add(
				array(
					"id" => $user_id,
					"phone" => convertToPhone($this->session->userdata("isphone")),
					"full_name" => $this->input->post("full_name"),
					"email" => $this->input->post("email"),
					"password" => md5($this->input->post("password")),
					"isActive" => 1,
					"isPhone" => 1,
					"isActive" => 0,
					"createdAt" => date("Y-m-d H:i:s")

				)
			);
			if ($insert) {


				$full_name = $this->input->post("full_name");

				$alert = array(
					"title" => "Success",
					"text" => "Your Account Has Been Created Successfully. Please Login to Chatbook",
					"type" => "success"
				);
				$this->session->unset_userdata("isphone");

				$this->session->set_flashdata('alert', $alert);
				redirect(base_url("login?reg=true&regname=$full_name"));
				die();
			} else {

				$alert = array(
					"title" => "Error",
					"text" => "Something went wrong, please try again later!",
					"type" => "error"
				);
				$this->session->set_flashdata('alert', $alert);
				redirect(base_url());
				die();
			}



			
			
		} else {
			$viewData = new stdClass();
			$viewData->imageFolder = $this->imageFolder;
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "confirm/register";
			$viewData->form_error = true;


			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}
	}

	public function redirect_register()
	{
		$isphone = $this->session->userdata("isphone");

		if ($isphone) {
			$this->session->unset_userdata("isphone");
			redirect(base_url('register'));
			die();
		} else {
			if (get_status_user()) {
				redirect(base_url());
				die();
			}
		}
	}

}
