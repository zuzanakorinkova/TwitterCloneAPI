<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location: ../../page_sign/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/index_app.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <title>FutTech : : Technology of the Future</title>
</head>
<body>
  <div id="page">
    <?php require_once(__DIR__.'/left.php') ?>
    <?php require_once(__DIR__.'/middle.php') ?>
    <?php require_once(__DIR__.'/right.php') ?>
  </div>
  
  <script src="https://kit.fontawesome.com/df600bcacf.js" crossorigin="anonymous"></script>
  <script src="../../js/app_index.js"></script>

</body>
</html>