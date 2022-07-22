<?php
include '../model/User.php';
class UserDAO
{
    private $database;
    public function __construct()
    {
        $this->database = new Database();
        $this->database = $this->database->getDatabase();
        $this->database->query("SET NAMES 'utf8'");
    }

    public function getUserByID($id)
    {
        if ($this->database->connect_error) {
            return false;
        } else {
            $query = $this->database->prepare('SELECT * FROM `user` WHERE `user`.`userID` = ?');
            $query->bind_param('s', $id);

            if ($query->execute()) {
                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    return new User($user['userID'], $user['email'], $user['fullName'], $user['gender'], $user['birthday'], $user['address'], $user['phoneNumber'], $user['password'], $user['avatar'], $user['levelID']);
                } else return false;
            } else return false;
        }
    }
    public function getUserByMail($email)
    {
        if ($this->database->connect_error) {
            return false;
        } else {
            $query = $this->database->prepare('SELECT * FROM `user` WHERE `user`.`email` = ?');
            $query->bind_param('s', $email);

            if ($query->execute()) {
                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    return new User($user['userID'], $user['email'], $user['fullName'], $user['gender'], $user['birthday'], $user['address'], $user['phoneNumber'], $user['password'], $user['avatar'], $user['levelID']);
                } else return false;
            } else return false;
        }
    }
    public function getUserByMailAndPassword($email, $password)
    {
        if ($this->database->connect_error) {
            return false;
        } else {
            $query = $this->database->prepare('SELECT * FROM `user` WHERE `user`.`email` = ? and `user`.`password` = ?');
            $query->bind_param('ss', $email, $password);

            if ($query->execute()) {
                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    return new User($user['userID'], $user['email'], $user['fullName'], $user['gender'], $user['birthday'], $user['address'], $user['phoneNumber'], $user['password'], $user['avatar'], $user['levelID']);
                } else return false;
            } else return false;
        }
    }
    public function AddUser($fullName, $email, $password, $levelID)
    {
        if ($this->database->connect_error) {
            return false;
        } else {
            $query = $this->database->prepare('INSERT INTO user(fullName,email,password,levelID) VALUES (?,?,?,?)');
            $query->bind_param('ssss', $fullName, $email, $password, $levelID);
            $query->execute();
        }
    }
    public function UpdateUser($fullName, $email, $password, $gender, $phoneNumber, $birthday, $address, $avatar, $userID)
    {
        if ($this->database->connect_error) {
            return false;
        } else {
            $query = $this->database->prepare('UPDATE user SET fullName=?, email=?, password=?, gender=?, phoneNumber=?,
            birthday=?, address = ?, avatar=? WHERE userID=?');
            $query->bind_param('sssssssss', $fullName, $email, $password, $gender, $phoneNumber, $birthday, $address, $avatar, $userID);
            $query->execute();
        }
    }
    public function getAllUsers()
    {
        if ($this->database->connect_error) {
            return false;
        } else {
            $query = $this->database->prepare('SELECT * FROM `user`');

            if ($query->execute()) {
                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    $users = [];
                    while ($row = $result->fetch_assoc()) {
                        $user = new User($row['userID'], $row['email'], $row['fullName'], $row['gender'], $row['birthday'], $row['address'], $row['phoneNumber'], $row['password'], $row['avatar'], $row['levelID']);
                        $users[] = $user;
                    }
                    return $users;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
