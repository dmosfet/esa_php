<?php

use Leaf\Router;

Router::get('/auth/login',['AuthController@login','name' => 'auth.login']);
Router::get('/auth/register',['AuthController@register','name' => 'auth.register']);
