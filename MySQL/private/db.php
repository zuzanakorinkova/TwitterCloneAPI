<?php

try{
  $dbUserName = 'root';
  $dbPassword = 'root'; // root | admin
  $dbConnection = 'mysql:host=localhost; dbname=futur_tech; charset=utf8mb4'; 
  // utf8 every character in the world
  // utf8mb4 every character and also emojies
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // try-catch
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM //[[]]
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //= ASSOCIATIVE / FETCH_OBJ = JSON 
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
  ];
  //collation: ci = case insensitive
  $db = new PDO(  $dbConnection, 
                  $dbUserName, 
                  $dbPassword , 
                  $options );
  
}catch(PDOException $ex){
http_response_code(500);
// echo $ex; - know what is the error
header('Content-Type: application/json');
echo '{"message":"Contact the system admin about error.'.__LINE__.'"}';
  exit();
}