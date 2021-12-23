<?php

function convertToPhone($text) {
	$invalid = array("(", ")", " ", "-", "_");
	$convert = array("","","","","");
	return strtolower(str_replace($invalid, $convert, $text));
}

function get_status_user() {
    $t = &get_instance();

    $user = $t->session->userdata("user");

    if ($user) {
        return $user;
    }
    else {
        return false;
    }
}

function get_isUserid($friend_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'id' => $friend_id
        )
    );

    if ($friend) {
        return true;
    }
    else {
        return false;
    }
}

function isUsername($friend_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'user_name' => $friend_id
        )
    );

    if ($friend) {
        return true;
    }
    else {
        return false;
    }

}

function get_user_pass($user_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'id' => $user_id
        )
    );

    if ($friend) {
        return $friend->password;
    }
    else {
        return false;
    }
}

function get_friends_name($friend_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'id' => $friend_id
        )
    );

    if ($friend) {
        return $friend->full_name;
    }
    else {
        return 'arkadaşın adı tanımlı değil';
    }
}


function get_friends_img($friend_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'id' => $friend_id
        )
    );

    if ($friend) {
        if ($friend->img_url !== '' or $friend->img_url !== null) {
            return $friend->img_url;
        } else {
            return false;
        }

    }
    else {
        return false;
    }
}

function onlineTimeUpdate($user_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $user = $t->user_model->update(
        array(
            'id' => $user_id
        ),
        array(
            "lastOnline" => date("Y-m-d H:i:s")
        )
    );

    if ($user) {
        return true;
    }
    else {
        return 'arkadaşın durumu bilinemiyor';
    }

}

function get_lastOnlinedate($friend_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $user = $t->user_model->get(
        array(
            'id' => $friend_id
        )
    );

    if ($user) {
        return $user->lastOnline;
    }
    else {
        return 'arkadaşın durumu bilinemiyor';
    }

}

function get_isActive($friend_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'id' => $friend_id
        )
    );

    if ($friend) {
        return $friend->isStatus;
    }
    else {
        return 'arkadaşın durumu bilinemiyor';
    }

}


function get_isUsername($id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'id' => $id
        )
    );

    if ($friend) {
        return $friend->user_name;
    }
    else {
        return false;
    }

}

function convertUsernameToid($username = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'user_name' => $username
        )
    );

    if ($friend) {
        return $friend->id;
    }
    else {
        return 'arkadaşın adı tanımlı değil';
    }
}

function convertToSeo($text) {
	$turkce = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "i", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?" , "*", "_" , "|", "=", "(" , ")" , "[" , "]", "{" , "}");
	$convert = array("c" , "c" ,"g" ,"g" ,"u" ,"u" ,"o" ,"o" ,"i" ,"i" ,"i" ,"s" ,"s" ,"-" , "-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,"-" ,);
	return strtolower(str_replace($turkce, $convert, $text));
}

function get_friends_phone($friend_id = 0) {
    $t = &get_instance();
    $t->load->model('user_model');

    $friend = $t->user_model->get(
        array(
            'id' => $friend_id
        )
    );

    if ($friend) {
        if ($friend->isPhone === '0') {
            return 'Bu hesabın numarası gizlidir.';
        }
        else if ($friend->isPhone === '1') {
            return '0' . $friend->phone;
        }
    }
    else {
        return 'arkadaşın adı tanımlı değil';
    }
}

function isFriend($friend_id = 0) {
    $session_user = get_status_user();
    $t = &get_instance();
    $t->load->model('friend_model');

    $isUser = $t->friend_model->get(
        array(
            'user_id' => $session_user->id,
            'friend_id'=> $friend_id
        )
    );

    if ($isUser) {
        if ($isUser->isActive === '1') {
            return 'friend';
        } else  {
            return 'sendFriend';
        }

    } else {
        $isNotUser = $t->friend_model->get(
            array(
                'user_id' => $friend_id,
                'friend_id'=> $session_user->id,
                'isActive' => 0
            )
        );

        if ($isNotUser) {
            return 'doFriend';
        }
        else {
            return 'noFriend';
        }
    }
}

function isİnvite($user_id = 0) {
    $t = &get_instance();
    $t->load->model('friend_model');

    $isUser = $t->friend_model->get_all(
        array(
            'friend_id' => $user_id,
            'isActive' => 0
        )
    );

    if ($isUser) {
        return $isUser;

    } else {
        return false;
    }
}

function isİnviteRow($user_id = 0) {
    $t = &get_instance();
    $t->load->model('friend_model');

    $isUserRow = $t->friend_model->row_count(
        array(
            'friend_id' => $user_id,
            'isActive' => 0
        )
    );

    if ($isUserRow) {
        return $isUserRow;

    } else {
        return false;
    }
}


function getMessage($friend_id = 0) {
    $user = get_status_user();
    $t = &get_instance();
    $t->load->model('chat_model');

    $Messages = $t->chat_model->get_user_message(
        'user_id',
        array(
            $user->id , $friend_id
        ),
        'friend_id',
        array(
            $user->id , $friend_id
        ),
        'createdAt ASC'
    );

    if ($Messages) {
        return $Messages;

    } else {
        return false;
    }
}

function isReaded_Messages($friend_id = 0) {
    $user = get_status_user();
    $t = &get_instance();
    $t->load->model('chat_model');

    $Messages = $t->chat_model->get_all(
        array(
            'user_id' => $friend_id,
            'friend_id' => $user->id,
            'isReaded' => 0,
            'isActive' => 1
        )
    );

    if ($Messages) {
        return $Messages;

    } else {
        return false;
    }
}

function Readed_Message($friend_id = 0) {
    $user = get_status_user();
    $t = &get_instance();
    $t->load->model('chat_model');

    $Messages = $t->chat_model->update(
        array(
            'user_id' => $friend_id,
            'friend_id' => $user->id,
            'isReaded' => 0,
            'isActive' => 1
        ), 
        array(
            'isReaded' => 1
        )
    );

    if ($Messages) {
        return $Messages;

    } else {
        return false;
    }
}
