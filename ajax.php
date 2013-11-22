<?php
require('database.php');
/**
 * Created by PhpStorm.
 * User: mo0
 * Date: 01.11.13
 * Time: 19:29
 */
if(($_POST['name']) && ($_POST['email']) && ($_POST['text'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $text = htmlspecialchars($_POST['text']);
    $errors = '';

    // Server-side validation
    if(strlen($name) == 0) {
        $errors .= 'Введите имя<br />';
    }
    elseif(preg_match('/^[a-zA-Z- ]+$/', $name) == 0) {
        $errors .= 'Введите корректное имя<br />';
    }
    elseif(sizeof(explode(' ', $name)) < 3) {
        $errors .= 'Минимум  три слова<br />';
    }
    elseif(strlen($name) > 50) {
        $errors .= '50 символов максимум<br />';
    }

    if(strlen($email) == 0) {
        $errors .= 'Введите email<br />';
    }
    elseif(preg_match('/\S+@\S+\.\S+/', $email) == 0) {
        $errors .= 'Введите корректный email<br />';
    }
    elseif(strlen($email) > 50) {
        $errors .= '50 символов максимум<br />';
    }
    if(strlen($text) == 0) {
        $errors .= 'Введите текст<br />';
    }
    elseif(strlen($text) > 200) {
        $errors .= '200 символов максимум<br />';
    }
    else {
        echo(Database::getInstance()->addToDb($name, $email, $text));
        return;
    }
    echo('hackerz!1');
    return;
}