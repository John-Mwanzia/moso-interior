<?php

declare(strict_types=1);

function check_signup_errors(){
    if(isset($_SESSION['signup_errors'])){
        $errors = $_SESSION['signup_errors'];
        foreach($errors as $error){
            echo "<p>$error</p>";
        }
        // unset the session variable
        unset($_SESSION['signup_errors']);
    }
}

function signup_success(){
    if(isset($_SESSION['signup-success'])){
        echo "<p>".$_SESSION['signup-success']."</p>";
        unset($_SESSION['signup-success']);
    }
}


function signup_error(){
    if(isset($_SESSION['signup-error'])){
        echo "<p>".$_SESSION['signup-error']."</p>";
        unset($_SESSION['signup-error']);
    }
}