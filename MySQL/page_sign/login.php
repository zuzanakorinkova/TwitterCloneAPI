<?php
session_start();
if(isset($_SESSION['name'])){
    header('Location: ../../page_index/home/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sign_app.css">
    <title>Login - SQL</title>
</head>
<body>
    <section class="s1">
        <section class="s1_1">
           <h1>Welcome back.</h1>
           <p>let's see more of the newest tech trends,
            futuristic discussions and further.</p>
            <a href="">Learn more</a>
            <!-- <hr>
            <p>“What computer is to me, it’s the most remarcable tool we
            have come up with. It’s equivalent for a bicycle in our minds.” <br>
            <span id="name"> - Steve Jobs</span>
            </p> -->
        </section>
        <section class="s1_2">
        <form class="s1_2_1" onsubmit="login(); validateLogin(); return false">
                <h2>User login.</h2>
                <div>
                    <input type="text" name="email" placeholder="email" data-type="email" data-min="2" data-max="7">
                    <label id="labelEmail" for="email">email must be valid</label>
                    <!-- make validation with wrong email -->
                </div>
                <div>
                    <input type="password" name="password" placeholder="password" data-type="string" data-min="5" data-max="10" data-match="password">
                    <label id="labelPass" for="password">password is min 5 and max 255 characters</label>
                </div>
                <div class="s1_2_1_2">
                    <div id="signUp">
                        <button>Login</button>
                        <p>create an account? </p> <a href="signup.php">Sign up</a> 
                    </div>
                </div>
            </form>
        </section>
    </section>
    <script src="../js/validator.js"></script>
    <script src="../js/app_sign.js"></script>
</body>