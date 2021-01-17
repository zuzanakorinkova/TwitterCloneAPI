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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <title>FutTech : : Technology of the Futures</title>
</head>
<body>
<section class="s1">
        <section class="s1_1">
           <h1>Create an account.</h1>
           <p>and get access to the newest tech trends,
            futuristic discussions and further.</p>
            <a href="">Learn more</a>
            <!-- <hr>
            <p>“What computer is to me, it’s the most remarcable tool we
            have come up with. It’s equivalent for a bicycle in our minds.” <br>
            <span id="name"> - Steve Jobs</span>
            </p> -->
        </section>
        <section class="s1_2">
        <form class="s1_2_1" onsubmit="validateSignup(); signup(); return false">
                <div class="s1_2_1_1">
                    <span id="formName">
                        <input class="input" type="text" name="name" placeholder="first name" data-type="string" data-min="2" data-max="7">
                        <label id="labelFirst" for="firstName">field must be min 2 and max 50 characters</label>
                    </span>
                    <span id="formLastName">
                        <input class="input"  type="text" name="lastName" placeholder="last name" data-type="string" data-min="2" data-max="7">
                        <label id="labelLast"  for="lastName">field must be min 2 and max 50 characters</label>
                    </span>
                </div>
                <div>
                    <input class="input" type="text" name="email" placeholder="email" data-type="email" data-min="2" data-max="7">
                    <label id="labelEmail" for="email">email must be valid</label>
                </div>
                <div>
                        <input class="input"  type="text" name="country" placeholder="country" data-type="string" data-min="2" data-max="7">
                        <label id="labelCountry"  for="country">field must be min 2 and max 50 characters</label>
                </div>
                <div>
                    <input class="input" type="password" name="password" placeholder="password" data-type="string" data-min="5" data-max="10" data-match="password">
                    <label id="labelPass" for="password">password must be min 5 and max 255 characters</label>
                </div>
                <div>
                    <input class="input"  type="password" name="confirmPassword" placeholder="confirm your password" data-type="string" data-match="password">
                    <label id="labelConfirmPassword"  for="password">password must match</label>
                </div>
                <div class="s1_2_1_2">
                    <div id="signUp">
                        <button>Sign up</button>
                        <p>already have account? </p> <a href="login.php">Login</a> 
                    </div>
                </div>
            </form>
        </section>
    </section>
    <script src="../js/app_sign.js"></script>
    <script src="../js/validator.js"></script>
</body>
</html>