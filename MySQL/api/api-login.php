<?php
if(!isset($_POST['email'])){
    sendError(400, 'missing email',__LINE__);
}
if(!isset($_POST['password'])){
    sendError(400, 'missing password',__LINE__);
}
if(strlen($_POST['password']) < 5){
    sendError(400, 'the password must be at least 5 characters',__LINE__);
}
if(strlen($_POST['password']) > 50){
    sendError(400, 'the password cannot be more than 50 characters',__LINE__);
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    sendError(400, 'email is not valid',__LINE__);
}

require_once(__DIR__.'/../private/db.php');
try{
$query = $db->prepare('SELECT * FROM users WHERE sEmail = :email LIMIT 1');
$query->bindValue(':email', $_POST['email']);
$query->execute();
$row = $query->fetch();
if(password_verify($_POST['password'], $row[4])){
   session_start();
   $_SESSION['userId'] = $row[0];
   $_SESSION['name'] = $row[1];
   $_SESSION['lastName'] = $row[2];
   $_SESSION['avatar'] = $row[6];
//    $_SESSION['email'] = $row[3];
   echo 'logged in';
   exit();
}else{
    http_response_code(400);
    echo 'could not log in';
}


}catch(Exeption $ex){
echo $ex;
sendError(500, 'system under maintainance', __LINE__);
}



function sendError($iCode, $sMessage, $iLine){
    http_response_code($iCode);
    echo '{"message":"'.$sMessage.'","error":"'.$iLine.'"}';
    exit();
}