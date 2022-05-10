<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'] = array(
    'class'    => 'LanguageLoader',
    'function' => 'initialize',
    'filename' => 'LanguageLoader.php',
    'filepath' => 'hooks'
);
$hook['pre_system'] = array(
    'function' => 'auth_constants',
    'filename' => 'auth_constants.php',
    'filepath' => 'third_party/community_auth/hooks'
);

$hook['post_system'] = array(
    'function' => 'auth_sess_check',
    'filename' => 'auth_sess_check.php',
    'filepath' => 'third_party/community_auth/hooks'
);