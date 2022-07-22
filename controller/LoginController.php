<?php
session_start();
include_once('../Utils/Database.php');
include_once('../model/DAO/UserDAO.php');
include_once('../model/DAO/ProductDAO.php');
include_once('../model/DAO/SizeDAO.php');
include('../model/DAO/CategoryDAO.php');

if (isset($_GET['act'])) {
    $act = $_GET['act'];
} else {
    $act = 'index';
}
$productDAO = new ProductDAO();
$userDAO = new UserDAO();
$sizeDAO = new SizeDAO();
switch ($act) {
        // Show trang chủ
    case 'index':
        include_once('../view/index.php');
        break;
        // Show form đăng ký đăng nhập
    case 'showLogin':
        include_once('../view/login_regin.php');
        break;
        // Show trang thông tin tài khoản
    case 'showProfile':
        include_once('../view/profile.php');
        break;
        // Hiển thị chi tiết sản phẩm
    case 'detail':
        include_once('../view/detail.php');
        break;
    case 'admin':
        include_once('../view/admin.php');
        break;
        // Xử lý đăng nhập
    case 'login':
        $error = false;
        if (isset($_POST['email']) || isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $us = $userDAO->getUserByMailAndPassword($email, $password);

            if ($error !== false || !$us) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Password nhập không đúng'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng Nhập thành công'
                ));
                $_SESSION['userId'] = $us->getID();
                $_SESSION['email'] = $us->getEmail();
                $_SESSION['name'] = $us->getFullName();
                $_SESSION['avatar'] = $us->getAvatar();
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thông tin đăng nhập không đúng'
            ));

            exit;
        }
        break;
    case 'register':
        $error = false;
        if (isset($_POST['email']) || isset($_POST['name']) || isset($_POST['password']) || isset($_POST['repassword'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullName = $_POST['name'];
            $repassword = $_POST['repassword'];
            $levelID = 2;
            $userDAO->AddUser($fullName, $email, $password, $levelID);
            if ($error !== false) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'có lỗi khi đăng ký, xin thử lại'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng ký thành công'
                ));

                exit;
            }
        }

        break;
    case 'profile':
        if (isset($_POST['luu'])) {

            $userID = $_SESSION['userId'];
            $fullName = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $gender = $_POST['gender'];
            $phoneNumber = $_POST['soDT'];
            $birthday = $_POST['birthday'];
            $address = $_POST['diaChi'];
            $target_dir = "images/";
            $file = basename($_FILES['avatar']['name']);
            $target_file = $target_dir . $file;
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            $avatar =  $_FILES['avatar']['name'];


            $user = $userDAO->UpdateUser($fullName, $email, $password, $gender, $phoneNumber, $birthday, $address, $avatar, $userID);
            header('Refresh: 0.5; ?act=showProfile');
        }
        break;
    case 'logout':
        session_destroy();
        header('Refresh: 0; ?act=index');
        break;
    case 'check_mail':
        $email = $_GET['email'];
        $query = $userDAO->getUserByMail($email);
        if ($query != null) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
        break;
    case 'check_mail_login':
        $email = $_GET['email'];
        $query = $userDAO->getUserByMail($email);
        if ($query != null) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
        break;
    default:
        # code...
        break;
}
