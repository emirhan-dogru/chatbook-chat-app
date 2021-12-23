<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'homepage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = "userop/login";
$route['go_login'] = "userop/do_phone";
$route['login/confirm'] = "userop/confirm_login";
$route['login/confirm/isPassword'] = "userop/do_password";
$route['logout'] = "userop/logout";

$route['register'] = "userop/register";
$route['isRegister'] = "userop/isphone";
$route['register/confirm'] = "userop/confirm_register";
$route['register/confirm/save'] = "userop/do_register";
$route['go_register'] = "userop/redirect_register";

$route['profil/([a-z 0-9 -]+)'] = "user/get_profile/$1";
$route['profil_update/([a-z 0-9 -]+)'] = "user/updateProfile/$1";
$route['change_password/([a-z 0-9 -]+)'] = "user/changePassword/$1";
$route['chat/([a-z 0-9 -]+)'] = "homepage/chat/$1";
$route['removeFriend/([a-z 0-9 -]+)'] = "homepage/removeFriend/$1";
$route['friends'] = "user/get_friends";
$route['search'] = "user/search_friend";
$route['isUser'] = "user/search_user";
$route['addFriend'] = "homepage/addFriend";
$route['acceptFriend'] = "homepage/acceptFriend";
$route['disallowFriend'] = "homepage/disallowFriend";
$route['inviteToCancel'] = "homepage/inviteToCancel";
$route['message_send/([a-z 0-9 -]+)'] = "homepage/chat_Send/$1";

$route['reload_message/([a-z 0-9 -]+)'] = "homepage/refreshMessage/$1";
$route['reload_friendList'] = "homepage/refresh_friendsList";
