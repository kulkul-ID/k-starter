<?php

$auth = array(
    'table'             => 'users',
    'fields'            => array(
        'email',
        'password'
    ),
    'encryption_fields' => array(
        'password'
    ),
    'encryption_key'    => ''
);

return $auth;