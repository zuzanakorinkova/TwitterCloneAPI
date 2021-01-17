<?php
// ALTER TABLE users ADD FULLTEXT(sName, sLastName)

if(!isset($_GET['userProfileName'])){
    sendError(400, 'missing user profile name', __LINE__);
}
if(strlen($_GET['userProfileName']) < 1){
    sendError(400, 'must insert at least 1 character', __LINE__);
}
if(strlen($_GET['userProfileName']) > 100){
    sendError(400, 'must insert no more than 100 characters', __LINE__);
}

require_once(__DIR__.'/../private/db.php');
try{
    $query = $db->prepare('SELECT iUserId AS id, sName AS firstName, sLastName AS lastName, sEmail AS email, sAvatarUrl AS userImage FROM users WHERE MATCH(sName, sLastName) AGAINST(:sString IN BOOLEAN MODE)');
    $query->bindValue(':sString',$_GET['userProfileName']);
    $query->execute();
    $ajData = $query->fetchAll();
    
    header('Content-Type: application/json');
    echo json_encode($ajData);
    
    }catch(Exeption $ex){
        sendError(400, 'error', __LINE__);
    }
    
    // ALTER TABLE users ADD FULLTEXT(sUserProfileName)
    // SELECT iId, sName FROM users WHERE Match(sName) Against("john")
    
    
    
    
    
    // #############################################
    function sendError($iResponseCode, $sMessage, $iLine){
        http_response_code($iResponseCode);
        header('Content-Type: application/json');
        echo '{"message":"'.$sMessage.'", "error":'.$iLine.'}';
        exit();
      }