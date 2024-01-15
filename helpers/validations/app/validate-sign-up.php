<?php

function isSignUpValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] = trim($req[$key]);
    }

    $errors = [];

    if (empty($req['name']) || strlen($req['name']) < 3 || strlen($req['name']) > 255) {
        $errors['name'] = 'The name field cannot be empty and must be between 3 and 255 characters.';
    }

    if (empty($req['lastname']) || strlen($req['lastname']) < 3 || strlen($req['lastname']) > 255) {
        $errors['lastname'] = 'The lastname field cannot be empty and must be between 3 and 255 characters.';
    }

    if (empty($req['phoneNumber']) || strlen($req['phoneNumber']) !== 9) {
        $errors['phoneNumber'] = 'The phone field cannot be empty and must be exactly 9 characters.';
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field must not be empty and must have an email format, such as: name@example.com.';
    }

    if (getByEmail($req['email'])) {
        $errors['email'] = 'Email already registered in our system. If you cannot remember your password, please contact us.';
        return ['invalid' => $errors];
    }

    if (empty($req['password']) || strlen($req['password']) < 6) {
        $errors['password'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if (!empty($req['confirm_password']) && ($req['confirm_password']) != $req['password']) {
        $errors['confirm_password'] = 'The Confirm Password field must not be empty and must be the same as the Password field.';
    }

    if (!empty($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
?>
