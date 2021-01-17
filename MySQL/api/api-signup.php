<?php

if(!isset($_POST['name'])){
    sendError(400, 'missing name',__LINE__);
}
if(!isset($_POST['lastName'])){
    sendError(400, 'missing last name',__LINE__);
}
if(!isset($_POST['country'])){
    sendError(400, 'missing country',__LINE__);
}
if(!isset($_POST['email'])){
    sendError(400, 'missing email',__LINE__);
}
if(!isset($_POST['password'])){
    sendError(400, 'missing password',__LINE__);
}
if(strlen($_POST['name']) < 2){
    sendError(400, 'the first name must be at least 2 characters',__LINE__);
}
if(strlen($_POST['name']) > 20){
    sendError(400, 'the first name cannot be more than 50 characters',__LINE__);
}
if(strlen($_POST['lastName']) < 2){
    sendError(400, 'the last name must be at least 2 characters',__LINE__);
}
if(strlen($_POST['lastName']) > 50){
    sendError(400, 'the last name cannot be more than 50 characters',__LINE__);
}
if(strlen($_POST['country']) < 2){
    sendError(400, 'the country must be at least 2 characters',__LINE__);
}
if(strlen($_POST['country']) > 140){
    sendError(400, 'the country cannot be more than 140 characters',__LINE__);
}
if(strlen($_POST['password']) < 5){
    sendError(400, 'the password must be at least 5 characters',__LINE__);
}
if(strlen($_POST['password']) > 100){
    sendError(400, 'the password cannot be more than 100 characters',__LINE__);
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    sendError(400, 'email is not valid',__LINE__);
}
if( $_POST['password'] !=  $_POST['confirmPassword'] ){
    sendError(400, 'passwords do not match', __LINE__);
  }

  $image_path = 'avatar_blue.png';

require_once(__DIR__.'/../private/db.php');

try{
    $query = $db->prepare('SELECT * from users WHERE sEmail = :sEmail LIMIT 1');
    $query->bindValue(':sEmail', $_POST['email']);
    $query->execute();
    $aRow = $query->fetch();
    if($aRow){
        sendError(500, 'user already exists', __LINE__);
    }

// // INSERT INTO `users`  VALUES (NULL, 'AA', 'AAA', '@a', '123456', 'cc', 'ccc', '0', '', CURRENT_TIMESTAMP);
$query = $db->prepare('INSERT INTO users VALUES(:iUserId, :sName, :sLastName, :sEmail, :sPassword, :sCountry, :sAvatarUrl, :iTotalFollowing, :iTotalPosts, :bActive, :sVerificationCode, NOW())');    
$query->bindValue(':iUserId', null);
$query->bindValue(':sName', $_POST['name']);
$query->bindValue(':sLastName', $_POST['lastName']);
$query->bindValue(':sEmail', $_POST['email']);
$query->bindValue(':sPassword', password_hash($_POST['password'], PASSWORD_DEFAULT));
$query->bindValue(':sCountry', $_POST['country']);
$query->bindValue(':sAvatarUrl', $image_path);
$query->bindValue(':iTotalFollowing', 0);
$query->bindValue(':iTotalPosts', 0);
$query->bindValue(':bActive', 0);
$query->bindValue(':sVerificationCode', uniqid());
$query->execute();

session_start();
$_SESSION['userId'] = $db->lastInsertId();
$_SESSION['name'] = $_POST['name'];
$_SESSION['lastname'] = $_POST['lastName'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['avatar'] = $image_path;

header('Content-Type: application/json');
echo '{"message":"user created","id":"'.$db->lastInsertId().'"}';

}catch(Exeption $ex){
    echo $ex;
    sendError(500, 'contact system administrator', __LINE__);
}




function sendError($iCode, $sMessage, $iLine){
    http_response_code($iCode);
    echo '{"message":"'.$sMessage.'","error":"'.$iLine.'"}';
    exit();
}