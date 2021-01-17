<?php
session_start();

if(!isset($_POST['name'])){
    sendError(200, 'missing name is ok',__LINE__);
}
if(!isset($_POST['lastName'])){
    sendError(200, 'missing last name is ok',__LINE__);
}
if(!isset($_POST['country'])){
    sendError(200, 'missing country is ok',__LINE__);
}
if(!isset($_POST['email'])){
    sendError(200, 'missing email is ok',__LINE__);
}
if(strlen($_POST['name']) < 2){
    sendError(200, 'the first name must be at least 2 characters',__LINE__);
}
if(strlen($_POST['name']) > 20){
    sendError(200, 'the first name cannot be more than 50 characters',__LINE__);
}
if(strlen($_POST['lastName']) < 2){
    sendError(200, 'the last name must be at least 2 characters',__LINE__);
}
if(strlen($_POST['lastName']) > 50){
    sendError(200, 'the last name cannot be more than 50 characters',__LINE__);
}
if(strlen($_POST['country']) < 2){
    sendError(200, 'the country must be at least 2 characters',__LINE__);
}
if(strlen($_POST['country']) > 140){
    sendError(200, 'the country cannot be more than 140 characters',__LINE__);
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    sendError(400, 'email is not valid',__LINE__);
}
// $name = $_POST['name'];
// echo $name;
require_once(__DIR__.'/../private/db.php');
try{
$query = $db->prepare('UPDATE users SET sName = :name, sLastName = :lastName, sEmail = :email, sCountry = :country WHERE iUserId = :userId');
$query->bindValue(':name', $_POST['name']);
$query->bindValue(':lastName', $_POST['lastName']);
$query->bindValue(':email', $_POST['email']);
$query->bindValue(':country', $_POST['country']);
$query->bindValue(':userId', $_SESSION['userId']);
$query->execute();

header('Content-Type: application/json');
echo '{"updated rows":"'.$query->rowCount().'"}';


}catch(Exeption $ex){
    sendError(400, 'error', __LINE__);
    echo $ex;
}






// #############################################
function sendError($iResponseCode, $sMessage, $iLine){
    http_response_code($iResponseCode);
    header('Content-Type: application/json');
    echo '{"message":"'.$sMessage.'", "error":'.$iLine.'}';
    exit();
  }
  
  

