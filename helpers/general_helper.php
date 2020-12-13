<?php

use App\Models\User;

function isTeacherLogin()
{
    return (auth()->user()->user_type_id == User::TEACHER);
}

function isStudentLogin()
{
    return (auth()->user()->user_type_id == User::STUDENT);
}

function getLoginStudentId()
{
    return auth()->user()->student->id;
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}