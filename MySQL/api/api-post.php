<?php
session_start();

// For testing via postman, delete this line in production
// $_SESSION['userId'] = 3;

if(!isset($_POST['post'])){
    sendError(400, 'missing post',__LINE__);
}

if(strlen($_POST['post']) < 2){
    sendError(400, 'the post must be at least 5 characters',__LINE__);
}
if(strlen($_POST['post']) > 2000){
    sendError(400, 'the post cannot be more than 2000 characters',__LINE__);
}

require_once(__DIR__.'/../private/db.php');
try{
//INSERT INTO `posts` (`iPostId`, `iUserFk`, `sPost`, `iLikes`, `bActive`, `dCreated`) VALUES (NULL, '3', 'Lorem  ', '1', '1', CURRENT_TIMESTAMP);
$query = $db->prepare('INSERT INTO posts VALUES( NULL, :iUserFk, :sPost, :iTotalLikes, :iTotalComments, :bActive, NOW())');
$query->bindValue(':iUserFk', $_SESSION['userId']);
$query->bindValue(':sPost', $_POST['post']);
$query->bindValue('iTotalLikes', 0);
$query->bindValue('iTotalComments', 0);
$query->bindValue(':bActive', 1);
$query->execute();

$iPostId = $db->lastInsertId();

$query = $db->prepare('SELECT sName, sLastName, sAvatarUrl FROM users WHERE iUserId = :userId');
$query->bindValue(':userId',$_SESSION['userId']);
$query->execute();
$data = $query->fetchAll();

// $query = $db->prepare('SELECT users.sName, users.sLastName, users.sAvatarUrl, posts.* FROM users JOIN posts ON users.iUserId = posts.iUserFk WHERE users.iUserId = :userId');
// $query->bindValue(':userId', $_SESSION['userId']);
// $query->execute();
// $row = $query->fetch();


header('Content-Type: application/json');
$ajData = json_encode($data);
echo '{"id":'.$iPostId.',"user_data":'.$ajData.'}';
//   echo '{"id":'.$iPostId.',"name":'.$row[0].'}';
 



}catch(Exeption $ex){
echo $ex;
sendError(500, 'system under maintainance', __LINE__);
}



function sendError($iCode, $sMessage, $iLine){
    http_response_code($iCode);
    echo '{"message":"'.$sMessage.'","error":"'.$iLine.'"}';
    exit();
}