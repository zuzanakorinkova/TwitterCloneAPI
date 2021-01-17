<?php
session_start();
$_SESSION['userId'] = 3;


require_once(__DIR__.'/../private/db.php');

try{
    $query = $db->prepare('SELECT * FROM trends');
    $query->execute();
    $trends = $query->fetchAll();
foreach($trends as $trend){
   echo $trend[2];
}
  

}catch(Exeption $ex){
    echo $ex;
}

            