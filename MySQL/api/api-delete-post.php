<?php

// Validate the ID from POST
if( ! isset($_POST['id']) ){
  sendError(400, "missing id", __LINE__);
}
if( ! ctype_digit( $_POST['id'] ) ){
  sendError(400, "invalid id", __LINE__);
}

require_once(__DIR__.'/../private/db.php');
try{

  $q = $db->prepare('DELETE FROM posts WHERE iPostId = :id');
  $q->bindValue(':id', $_POST['id']);
  $q->execute();
  
  if($q->rowCount() == 0){
    sendError(400, "invalid id", __LINE__);
  }
  // success
  echo '{"deletedId":"'.$_POST['id'].'"}';
  exit;

}catch(Exception $ex){

}

// #############################################
function sendError($iResponseCode, $sMessage, $iLine){
  header('Content-Type: application/json');
  http_response_code($iResponseCode);
  echo '{"message":"'.$sMessage.'", "error":'.$iLine.'}';
  exit; 
}






