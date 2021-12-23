<?php

class User extends CI_Controller
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

        $this->load->model("user_model");
        $this->load->model("friend_model");

        date_default_timezone_set('Europe/Istanbul');
    }

    public function get_profile($profile_id = 0)
    {
        if (!get_isUserid($profile_id))
        {
            if (!isUsername($profile_id)) 
            {
                redirect(base_url());
                die();
            }
            else
            {
                $profile_id = convertUsernameToid($profile_id);
            }
        }

        if (!empty($profile_id)) {

            $profil = $this->user_model->get(
                array(
                    'id' => $profile_id
                )
            );

            // left bar arkadaşları listele
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
            $viewData->subViewFolder = "dashboard/profile/";
            $viewData->profil = $profil;
            $viewData->items = $items;


            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        } else {
            redirect(base_url());
            die();
        }
    }

    public function updateProfile($profile_id = 0)
    {
        $user = get_status_user();

        if (!get_isUserid($profile_id))
        {
            if (!isUsername($profile_id)) 
            {
                redirect(base_url());
                die();
            }
            else
            {
                $profile_id = convertUsernameToid($profile_id);
            }
        }

        if ($user->id === $profile_id) {

            $this->load->library("form_validation");
            $this->load->helper("security");

            $postPhone = $this->input->post('isPhone');
            $postUsername = $this->input->post('user_name');
            $Username = get_isUsername($profile_id);

            if (isset($postPhone) && !empty($postUsername)) {
                $isPhone = $this->input->post('isPhone');
            }  
            else {
                $isPhone = '1';
            }



            $this->form_validation->set_rules("full_name", "Full name", "required|trim|xss_clean");

            if ($postUsername === $Username) {
                $this->form_validation->set_rules("user_name", "User name", "trim|xss_clean");
            } 
            else {
                $this->form_validation->set_rules("user_name", "User name", "trim|is_unique[users.user_name]|xss_clean");
            }
            
            $this->form_validation->set_rules("bio", "Summary", "trim|max_length[150]|xss_clean");




            /*$this->form_validation->set_message(
                array(
                    "required" => "{field} field cannot be left blank",
                    "is_unique" => "Bu {field} previously recorded",
                    "max_length" => "{field} must be up to 150 characters long"
                )
            );*/

            $validate = $this->form_validation->run();

            if ($validate) {

                //Upload süreci
                if ($_FILES['img_url']['name'] !== '') {


                    $file_name = convertToSeo(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)) . "." . pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);

                    $config['allowed_types'] = "jpg|jpeg|png";
                    $config['upload_path'] = "uploads/$this->imageFolder/";
                    $config['file_name'] = $file_name;



                    $this->load->library("upload", $config);

                    $upload = $this->upload->do_upload("img_url");

                    if ($upload) {
                        $uploaded_file = $this->upload->data("file_name");

                        $data = array(
                            "full_name" => $this->input->post("full_name"),
                            "user_name" => convertToSeo($this->input->post("user_name")),
                            "bio" => $this->input->post("bio"),
                            "img_url" => $uploaded_file,
                            "isPhone" => $isPhone,
                            "isMail" => $this->input->post("isMail")
                        );
                    } else {
                        $alert = array(
                            "title" => "İşlem Başarısız",
                            "text" => "Görsel yüklenirken bir sorun oluştu!",
                            "type" => "error"
                        );
                        $this->session->set_flashdata('alert', $alert);
                        redirect(base_url());
                        die();
                    }
                } else {
                    $data = array(
                        "full_name" => $this->input->post("full_name"),
                        "user_name" => convertToSeo($this->input->post("user_name")),
                        "bio" => $this->input->post("bio"),
                        "isPhone" => $isPhone,
                        "isMail" => $this->input->post("isMail")
                    );
                }



                $update = $this->user_model->update(array("id" => $profile_id), $data);
                if ($update) {
                    if ($_FILES['img_url']['name'] !== '' && $user->img_url !== '') {
                        unlink("uploads/{$this->imageFolder}/$user->img_url");
                    }

                    $alert = array(
                        "title" => "Success",
                        "text" => "Your account has been successfully updated, log in again",
                        "type" => "success"
                    );
                } else {
                    $alert = array(
                        "title" => "Error",
                        "text" => "Something went wrong, please try again later!",
                        "type" => "error"
                    );
                }

                $this->session->set_flashdata("alert", $alert);
                $this->session->unset_userdata("user");
                redirect(base_url());
                die();
            } else {
                if (!empty($profile_id)) {

                    $profil = $this->user_model->get(
                        array(
                            'id' => $profile_id
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
                    $viewData->subViewFolder = "dashboard/profile/";
                    $viewData->form_error = true;
                    $viewData->profil = $profil;
                    $viewData->items = $items;
                    


                    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
                } else {
                    redirect(base_url());
                    die();
                }
            }
        } else {
            redirect(base_url());
            die();
        }
    }

    public function changePassword($profile_id = 0)
    {
        $user = get_status_user();

        if (!get_isUserid($profile_id))
        {
            if (!isUsername($profile_id)) 
            {
                redirect(base_url());
                die();
            }
            else
            {
                $profile_id = convertUsernameToid($profile_id);
            }
        }

        if ($user->id === $profile_id) {

         $current_pass = $this->input->post('current_password');

         if (md5($current_pass) !== get_user_pass($profile_id)) {

            redirect(base_url("profil/$profile_id?edit&form_password_error=true&text=$current_pass"));
            die();

        }

        $this->load->library("form_validation");
        $this->load->helper("security");


        $this->form_validation->set_rules("new_password", "Password", "required|trim|min_length[6]|max_length[15]|xss_clean");
        $this->form_validation->set_rules("confirm_paswword", "Password Confirm", "required|trim|matches[new_password]|xss_clean");




        /*$this->form_validation->set_message(
            array(
                "required" => "{field} field cannot be left blank",
                "matches" => "Passwords do not match",
                "min_length" => "Your password must be at least 6 characters long",
                "max_length" => "Your password must be up to 15 characters long"
            )
        );*/

        $validate = $this->form_validation->run();

        if ($validate) {


            $update = $this->user_model->update(array("id" => $profile_id), array("password" => md5($this->input->post('new_password'))));
            if ($update) {
                $alert = array(
                    "title" => "Success",
                    "text" => "Your password has been successfully updated",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "Error",
                    "text" => "Something went wrong, please try again later!",
                    "type" => "error"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
            die();
        } else {
            if (!empty($profile_id)) {

                $profil = $this->user_model->get(
                    array(
                        'id' => $profile_id
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
                $viewData->subViewFolder = "dashboard/profile/";
                $viewData->form_passwordchange_error = true;
                $viewData->current_password = $current_pass;
                $viewData->profil = $profil;
                $viewData->items = $items;



                $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            } else {
                redirect(base_url());
                die();
            }
        }
    } else {
        redirect(base_url());
        die();
    }
}

public function get_friends() {
    $user = get_status_user();
    $id = $user->id; 

    if (!empty($id)) {

        $friends = $this->friend_model->get_all(
            array(
                'user_id' => $id
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
    } else {
        redirect(base_url());
        die();
    }
}

public function search_friend() {
    $user = get_status_user();
    $id = $user->id; 

    if (!empty($id)) {

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
        $viewData->subViewFolder = "dashboard/add/";
        $viewData->items = $items;


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    } else {
        redirect(base_url());
        die();
    }
}


public function search_user() {
    $user = get_status_user();
    $search = $_GET['search'];

    $users = $this->user_model->like(
        array(
            'phone' => $search,
            'user_name' => $search
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
    $viewData->subViewFolder = "dashboard/add/";
    $viewData->items = $items;
    $viewData->users = $users;


    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

} 

}
