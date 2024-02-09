<?php

require("dbConnect.php");
include("functions.php");

session_start();

if(isset($_SESSION["verifiedUserEmail"])){

    if(isset($_POST["newPasswordButton"])){

        // Email has been cleaned by email_verification
        $email = $_SESSION["verifiedUserEmail"];
    
        if(!empty($_POST["newPassword"]) && !empty($_POST["confirmNewPassword"]) && ($_POST["newPassword"] == $_POST["confirmNewPassword"])){
    
            $newPassword = passwordLocker(clean($_POST["newPassword"]));
    
            passwordChanger($email, $newPassword, "user_login");
    
        }else{
            $_SESSION["passwordDiffer"] = "Yes";
        }
    
    }
    

}else if(isset($_SESSION["verifiedAdminEmail"])){
    if(isset($_POST["newPasswordButton"])){

        // Email has been cleaned by email_verification
        $email = $_SESSION["verifiedAdminEmail"];
    
        if(!empty($_POST["newPassword"]) && !empty($_POST["confirmNewPassword"]) && ($_POST["newPassword"] == $_POST["confirmNewPassword"])){
    
            $newPassword = passwordLocker(clean($_POST["newPassword"]));
    
            passwordChanger($email, $newPassword, "admin_login");
    
        }else{
            $_SESSION["passwordDiffer"] = "Yes";
        }
    
    }
}else{

    header("Location: email_verification.php");
}






?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="fmworks/toastr.css">

    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: sans-serif;
        }

        @font-face {
            font-family: lily;
            src: url(font/LilyScriptOne-Regular.ttf);
        }

        :root{
            --mainBlue: #465a65;
            --secondBlue: #60717b;
            --thirdBlue: #829097;
            --darkBrown: #635329;
            --firstGrey: #686868;
            --firstGreySub: #222544;
            --seconGrey: #f2f2f2;
            --backgroundGrey: #e6e7ee;
            --thirdGrey: #959595;
        }

        body{
            background-color: var(--mainBlue);
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url(photos/Login-rafiki.png) no-repeat fixed var(--mainBlue);
            background-position: center;
            background-size: contain;
            background-blend-mode: luminosity;
        }


        .section1{
            position: relative;
            width: 50%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .section1 .mainSection{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }


        .logoSec{
            width: 100%;
            height: auto;
            display: flex;
            position: fixed;
            top: 0;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
            padding-top: 10px;
            padding-left: 20px;
        }

        .logoSec>section{
            width: 80px;
            height: auto;
        }

        .logoSec>section>img{
            width: 100%;
            height: fit-content;
        }




        .section1 .mainSection .logoSec{
            width: 100%;
            height: auto;
            display: none;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
        }

        .section1 .mainSection .logoSec>section{
            width: 100px;
            height: auto;
        }

        .section1 .mainSection .logoSec>section>img{
            width: 100%;
            height: fit-content;
        }

        .section1 .mainSection .myForm{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            padding: 30px 30px 30px;
            margin-top: 100px;
        }

        .section1 .mainSection .myForm>section{
            width: 100%;
            height: auto;
            margin: 20px 0px;
            display: flex;
            flex-direction: column;
        }

        .section1 .mainSection .myForm .formHeading{
            font-size: x-large;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: lighter;
        }

        .section1 .mainSection .myForm .formItem>label{
            font-weight: bold;
            font-size: large;
            margin-bottom: 5px;
        }

        .section1 .mainSection .myForm .formItem>input{
            width: 100%;
            height: 40px;
            background-color: var(--seconGrey);
            /* border: 1px solid var(--firstGrey); */
            border: none;
            border-radius: 5px;
            padding-left: 20px;
        }

        .section1 .mainSection .myForm .formItem>span{
            font-size: small;
            color: red;
            margin-top: 5px;
        }

        .section1 .mainSection .myForm .submitButton>input{
            width: 100%;
            height: 45px;
            background-color: var(--mainBlue);
            border: 1px solid var(--mainBlue);
            border-radius: 10px;
            font-family: lily, 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: white;
            font-size: large;
            cursor: pointer;
        }


        @media only screen and (max-width: 1000px) {
            .section1{
                width: 70%;
            }
        }

        @media only screen and (max-width: 700px) {
            .section1{
                width: 80%;
            }
        }

        @media only screen and (max-width: 500px) {
            .section1{
                width: 100%;
            }

            .section1 .mainSection .myForm{
                padding: 30px 20px 30px;
            }
        }







    </style>
</head>
<body>

    <section class="logoSec">
        <section>
            <img src="photos/light.png" alt="Logo Image">
        </section>
    </section>

    
    <div class="section1">
        <section class="mainSection">
            <section class="logoSec">
                <section>
                    <img src="photos/logo.png" alt="Logo Image">
                </section>
            </section>
    
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="myForm">
                <section class="formHeading">
                    <h1>Create new password</h1>
                </section>
    
                <section class="formItem">
                    <label for="newPassword">New Password</label>
                    <input type="password" name="newPassword" id="newPassword" placeholder="Your New Password" autocomplete maxlength="20" minlength="6">
                </section>

                <section class="formItem">
                    <label for="confirmNewPassword">Confirm Password</label>
                    <input type="password" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm New Password" autocomplete maxlength="20" minlength="6">

                    <?php if(isset($_SESSION["passwordDiffer"]) && ($_SESSION["passwordDiffer"] == "Yes")){ 
                        echo "<span class='error'>Both passwords do not match</span>";
                        $_SESSION["passwordDiffer"] = "No"; } ?>
                </section>
    
                <section class="submitButton">
                    <input type="submit" value="Create" name="newPasswordButton">
                </section>
            </form>
        </section>
    </div>

    <script src="fmworks/jquery.js"></script>
    <script src="fmworks/toastr.min.js"></script>

    <!-- Toast Alert -->

    <?php
    if(isset($_SESSION["passChangeSuccess"]) && ($_SESSION["passChangeSuccess"] == "Yes")){
        echo "<script> toastr.success('You will be redirected shortly.', 'Password Change Successful', {timeOut: 5000}) </script>";
        $_SESSION["passChangeSuccess"] = "No";
    }

    if(isset($_SESSION["passChangeFail"]) && ($_SESSION["passChangeFail"] == "Yes")){
        echo "<script> toastr.error('You were unable to change your password.', 'Password Change Unsuccessful', {timeOut: 5000}) </script>";
        $_SESSION["passChangeFail"] = "No";
    }

    ?>
</body>
</html>