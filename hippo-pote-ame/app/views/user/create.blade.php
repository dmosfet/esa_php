<?php

$user = auth()->createUserFor([
    'username' => 'example',
    'email' => 'example@example.com',
    'password' => 'password'
]);

if ($user) {
    // user is saved
} else {
    // user is not saved
    $error = auth()->errors();
}
