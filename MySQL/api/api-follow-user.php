<?php
session_start();

if(!ctype_digit($_GET['followUserId'])){
    sendError(400, 'id must be a digit', __LINE__);
}

if(!isset($_GET['followUserId'])){
    sendError(400, 'missing id', __LINE__);
}

require_once(__DIR__.'/../private/db.php');

try{
$query = $db->prepare('INSERT INTO followers VALUES (:userIdFollower, :userIdFollowee, NOW());');
$query->bindValue(':userIdFollower', $_SESSION['userId']);
$query->bindValue(':userIdFollowee', $_GET['followUserId']);
$query->execute();

// if($query->execute()){
//     $q = $db->prepare('UPDATE users SET iTotalFollowers = iTotalFollowers + 1 WHERE iUserId = :userId');
//     $q->bindValue(':userId', $_SESSION['userId']);
//     $q->execute();
// }

header('Content-Type: application/json');
echo '{"message":"followed new user"}';


}catch(Exception $ex){
    sendError(500, 'error', __LINE__);
}

// #############################################
function sendError($iResponseCode, $sMessage, $iLine){
    http_response_code($iResponseCode);
    header('Content-Type: application/json');
    echo '{"message":"'.$sMessage.'", "error":'.$iLine.'}';
    exit();
  }