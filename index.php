<?php require "src/includes.php" ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
      integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=KoHo:wght@700&family=Lato&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles/style.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <header class="top-navigation">
      <p class="logo"><a href="http://localhost/Project/">Web Hotels</a></p>
      <div class="app-actions">
        <button id="login-btn">Sign In</button>
        <button id="register-btn">Register</button>
      </div>
    </header>

    <main id="app"></main>

    <div id="login-form" class="actions-form">
      <h2 class="form-type">Sign In</h2>
      <p class="form-text">And lets get your Hotel online!</p>
      <?php
        if (!empty($_GET["error"]) && $_GET["form"] === LOGIN_FORM) {
          echo "<p class='error-msg'>" . $_GET["error"] . "</p>";
        }
      ?>
      <form action="src/login.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username"  />

        <label for="password">Password</label>
        <input type="password" name="password" />

        <input type="submit" value="Sign In" />
      </form>
      <div class="extra">
        <button class="create-account" href="#">Create account</button>
        <button class="forgot-password" href="#">Forgot your password?</button>
      </div>
      <button id="close-login-form" class="close-form">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div id="register-form" class="actions-form">
      <h2 class="form-type">Register</h2>
      <p class="form-text">And lets get your Hotel online!</p>
      <?php
        if (!empty($_GET["error"]) && $_GET["form"] === REGISTER_FORM) {
          echo "<p class='error-msg'>". $_GET["error"] ."</p>";
        }
      ?>
      <form action="src/register.php" method="POST">
        <label for="email">Email</label>
        <input type="text" name="email" />

        <label for="username">Username</label>
        <input type="text" name="username" />

        <label for="password">Password</label>
        <input type="password" name="password" />

        <div class="recaptcha-container">
          <?php 
          echo "<div class='g-recaptcha' data-sitekey=".RECAPTCHA_KEY_CLIENT_SIDE."></div>"
          ?>
        </div>
        <input type="submit" value="Register" />
      </form>
      <div class="extra">
        <button class="login" href="#">Sign in</button>
        <button class="forgot-password" href="#">Forgot your password?</button>
      </div>
      <button id="close-register-form" class="close-form">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div id="backdrop" class="backdrop"></div>


    <script src="script.js"></script>
    <?php      
      if (!empty($_GET["error"])) {
        echo "<script type='text/javascript' defer>open{$_GET["form"]}FormHandler();</script>";
      }
    ?>
  </body>
</html>
