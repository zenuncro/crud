<?php

require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-user.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-password.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'create') {
        create($_POST);
    }

    if ($_POST['user'] == 'update') {
        update($_POST);
    }

    if ($_POST['user'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['user'] == 'password') {
        changePassword($_POST);
    }
}

if (isset($_GET['user'])) {
    if ($_GET['user'] == 'update') {
        $user = getById($_GET['id']);
        $user['action'] = 'update';
        $params = '?' . http_build_query($user);
        header('location: /crud/pages/secure/admin/user.php' . $params);
    }

    if ($_GET['user'] == 'delete') {
        $user = getById($_GET['id']);
        if ($user['administrator']) {
            $_SESSION['errors'] = ['This user cannot be deleted!'];
            header('location: /crud/pages/secure/admin/');
            return false;
        }

        $success = delete_user($user);

        if ($success) {
            $_SESSION['success'] = 'User deleted successfully!';
            header('location: /crud/pages/secure/admin/');
        }
    }
}

function create($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /crud/pages/secure/admin/user.php' . $params);
        return false;
    }

    $success = createUser($data);

    if ($success) {
        $_SESSION['success'] = 'User created successfully!';
        header('location: /crud/pages/secure/admin/');
    }
}

function update($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $_SESSION['action'] = 'update';
        $params = '?' . http_build_query($req);
        header('location: /crud/pages/secure/admin/user.php' . $params);

        return false;
    }

    $success = updateUser($data);

    if ($success) {
        $_SESSION['success'] = 'User successfully changed!';
        $data['action'] = 'update';
        $params = '?' . http_build_query($data);
        header('location: /crud/pages/secure/admin/user.php' . $params);
    }
}

function updateProfile($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /crud/pages/secure/user/profile.php' . $params);
    } else {
        $user = user();
        $data['id'] = $user['id'];
        $data['administrator'] = $user['administrator'];

        if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../assets/images/profileImages/';
            $uploadFile = $uploadDir . basename($_FILES['foto']['name']);
            
            move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile);

            $data['foto'] = basename($_FILES['foto']['name']);

            $imagePath = $uploadDir . $data['foto'];
            resizeImage($imagePath, 150, 150); 
        }

        $success = updateUser($data);

        if ($success) {
            $_SESSION['success'] = 'User successfully changed!';
            $_SESSION['action'] = 'update';
            $params = '?' . http_build_query($data);
            header('location: /crud/pages/secure/user/profile.php' . $params);
        }
    }
}

function resizeImage($imagePath, $newWidth, $newHeight)
{
    $imageInfo = pathinfo($imagePath);
    $imageExtension = strtolower($imageInfo['extension']);

    switch ($imageExtension) {
        case 'jpeg':
        case 'jpg':
            $source = imagecreatefromjpeg($imagePath);
            break;
        case 'png':
            $source = imagecreatefrompng($imagePath);
            break;
        case 'gif':
            $source = imagecreatefromgif($imagePath);
            break;
        default:
            return;
    }

    list($width, $height) = getimagesize($imagePath);
    $imageRatio = $width / $height;

    if ($newWidth / $newHeight > $imageRatio) {
        $newWidth = $newHeight * $imageRatio;
    } else {
        $newHeight = $newWidth / $imageRatio;
    }

    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    if ($source) {
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        switch ($imageExtension) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($newImage, $imagePath);
                break;
            case 'png':
                imagepng($newImage, $imagePath);
                break;
            case 'gif':
                imagegif($newImage, $imagePath);
                break;
        }

        imagedestroy($newImage);
        imagedestroy($source);
    }
}


function changePassword($req)
{
    $data = passwordIsValid($req);
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /crud/pages/secure/user/password.php' . $params);
    } else {
        $data['id'] = userId();
        $success = updatePassword($data);
        if ($success) {
            $_SESSION['success'] = 'Password successfully changed!';
            header('location: /crud/pages/secure/user/password.php');
        }
    }
}

function delete_user($user)
{
    $data = deleteUser($user['id']);
    return $data;
}
