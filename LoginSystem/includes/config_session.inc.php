<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

if(!isset($_SESSION['last_regeneration'])){ //If the session is not set, regenerate one.
    regenerate_session_id();
} else { //if the session has expired, regenerate another one.
    $interval = 30 * 60;
    if(time() - $_SESSION['last_regeneration'] >= $interval){
        regenerate_session_id();
    }
}

function regenerate_session_id(){
    session_regenerate_id();
    $_SESSION['last_regeneration'] = time();
}