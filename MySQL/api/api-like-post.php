<?php

if(!ctype_digit($_POST['id'])){
    sendError(400, 'id must be a digit', __LINE__);
}

if(!isset($_POST['id'])){
    sendError(400, 'missing id', __LINE__);
}

require_once(__DIR__.'/../private/db.php');
try{
$query = $db->prepare('UPDATE posts SET iTotalLikes = iTotalLikes + 1 WHERE iPostId = :postId');
$query->bindValue(':postId', $_POST['id']);
$query->execute();

header('Content-Type: application/json');
echo '{"message":"post liked"}';


}catch(Exeption $ex){
    sendError(500, 'error', __LINE__);
}






// #############################################
function sendError($iResponseCode, $sMessage, $iLine){
    http_response_code($iResponseCode);
    header('Content-Type: application/json');
    echo '{"message":"'.$sMessage.'", "error":'.$iLine.'}';
    exit();
  }
  
  