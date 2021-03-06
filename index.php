<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel = "stylesheet" href = "homestyle.css">
    <title>Spark In Dark</title>
  </head>
  <body>
    <header class = "Head">
      <h1 class = "MainTitle">Spark In Dark</h1>
    </header>
    <main>
      <div class = "WhatIsIt">
      <h1 style = "color: #05F2DB" >What is Spark In Dark?</h1>
      <h4 style = "color: #bababa; ">Spark In Dark is a web application that connect people in need of an any kind of help to those good souls in our society, that want to help other in their free time for free 😊.  <br> <br>
          Every user has option to ask for help, which can be anything from simple homework through voice call to something physical in real world. Other users, that want to help, can get in contact and try to resolve his problem and put their effort to do everything in their power to help him! After that, as thanks, helpers can get points for their work. <br>
          If you do not need help, but want to help, we will be glad to have you onboard! Just make an account and then search for your field of expertise or view the newest requests, simply click add and get in contact with those in need. <br> <br>
          Spark In Dark is providing you with text, voice and even video call to give you full online communication, but if problem is bigger than that, you can always meet up in real world! <br> <br>
      </div>
      <div class = "Works">
        <h1 style = "color: #05F2DB" >How it works?</h1>
        <h4 style = "color: #bababa;">1.) Just simply make an account. <br> 2.) Ask for help (Make Help Request) <br> 3.) Search for other Help Requests and Help other people! <br> 4.) Other people will conect with you and try to resolve your problem <br> 5.) That is all!! <br> Now, go ahead and make this world a better place . ;) :) . </h4>
      </div>
      <h2 class = "OurMoto">Those who want to help, people in need, without receiving any credit for their work, are the truly good souls. </h2>
      <video autoplay loop muted class = "TitleVideo">
        <source src = "Chat.mp4" type = "video/mp4">
      </video>
      <div class = "Register">
        <form method = "POST" action = "#">
            <h3 style = "font-size: 25px; text-align: center; ">Are you ready to help other people?</h3>
            <input name = "RFirstName" type = "text" placeholder = "Enter your First Name" required> <input name = "RLastName" type = "text" placeholder = "Enter your Last Name" required>
            <input name = "REmail" type = "text" placeholder = "Enter your e-mail" class = "RegistrationInput" required>
            <input name = "RPassword" type = "password" placeholder = "Enter your password" class = "RegistrationInput" required>
            <button name = "UserSignIn" type = "submit" class = "ProgrammerButton">Sign in</button>
            <?php
              if(isset($_POST['UserSignIn'])){

                include "connection.php";

                $FirsName = $_POST['RFirstName'];
                $LastName = $_POST['RLastName'];
                $Mail = $_POST['REmail'];
                $Password = $_POST['RPassword'];

                $Query = "INSERT INTO `users` VALUES (NULL, '$FirsName', '$LastName', '$Mail', '$Password', 0)";
                $Result = mysqli_query($Link, $Query) or die("Unable to create you an account :( . Please try again later on :) . ");

                $Number = mysqli_affected_rows($Link);
                if($Number > 0) {
                  echo "Registration went successful, Log in to your new account";
                }
                else {
                  echo "There was an error :(, please try again, later and we are excited that you want to join Spark In Dark :D . )";
                }

              }
            ?>
        </form>
      </div>
      <div class = "LogIn">
        <form action = "#" method = "POST">
            <h3 style = "font-size: 25px; text-align: center; color: #05F2DB; ">Welcome Back</h3>
            <input name = "LIMail" type = "text" placeholder = "Enter your E-Mail">
            <input name = "LIPassword" type = "password" placeholder = "Enter your password">
            <button name = "LogIn" type = "submit" class = "LogInButton">Log In</button>
            <?php
            if(isset($_POST['LogIn'])){

              include "connection.php";

              $Mail = $_POST['LIMail'];
              $Password = $_POST['LIPassword'];
              $SqlQuery = "SELECT * FROM `users` WHERE email = '$Mail' AND password = '$Password'";
              $Result = mysqli_query($Link, $SqlQuery) or die ("Connection Error :(. Please try again later on or contact me on srdjangrbic@zohomail.eu");
              $RowNumber = $Result ->num_rows;
              if($RowNumber > 0){
                $Row = mysqli_fetch_row($Result);

                $UserId = $Row[0];
                $FirstName = $Row[1];
                $LastName = $Row[2];
                $EMailAdress = $Row[3];
                $Password = $Row[4];

                $_SESSION['userid'] = $UserId;
                $_SESSION['firstname'] = $FirstName;
                $_SESSION['lastname'] = $LastName;
                $_SESSION['emailadress'] = $EMailAdress;
                $_SESSION['password'] = $Password;

                $_SESSION['currentlyopen'] = -1;

                header('Location: dashboard.php');
              }
              else{
                echo "<h5 style = 'position: absolute; left: 24%; color: #e0e0e0'>You entered wrong E-mail or Password</h5>";
              }
            }
             ?>
          </form>
      </div>
    </main>
    <footer>

    </footer>
  </body>
</html>
