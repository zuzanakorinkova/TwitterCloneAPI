<?php
session_start();
session_destroy();
header('Location: ../page_sign/login.php');