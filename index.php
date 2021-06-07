<?php session_start(); ?>
<?php require "src/is_logged_in.php"; ?>
<?php require "components/header.php"; ?>
<?php require "components/top-navigation.php"; ?>

    <?php 
      if ($userIsLoggedIn) {
        require "components/user-navigation.php";
      }
    ?>

    <main id="app">
      
    </main>

    <div id="login-form" class="actions-form">
      <h2 class="form-type">Sign In</h2>
      <p class="form-text">And lets get your Hotel online!</p>
      <?php
        if (isset($_GET["error"]) && $_GET["form"] === LOGIN_FORM) {
          echo "<p class='error-msg'>" . $_GET["error"] . "</p>";
        } else if (isset($_GET["success"]) && $_GET["form"] === LOGIN_FORM) {
          echo "<p class='success-msg'>" . $_GET["success"] . "</p>";
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
        if (isset($_GET["error"]) && $_GET["form"] === REGISTER_FORM) {
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

    <div id="activation-form" class="actions-form">
      <h2 class="form-type">Just one more step, let's verify your email</h2>
      <?php
      echo "<p class='form-text'>We already send a code to <strong class='activation-email'>". $_GET["email"] ."</strong>, please check your inbox and insert the code in form below to verify your email</p>";
      ?>
      <?php
        if (!empty($_GET["error"]) && $_GET["form"] === ACCOUNT_ACTIVATION_FORM) {
          echo "<p class='error-msg'>" . $_GET["error"] . "</p>";
        }
      ?>
      <form action="src/activate.php" method="POST">
      <div class="inputs-container">
        <?php
          echo "<input type='email' name='email' value='". $_GET["email"] ."'/>";
        ?>
        <input type="number" name="n1" /><input type="number" name="n2" /><input type="number" name="n3" /><input type="number" name="n4" /><input type="number" name="n5" />
        <button type="submit" name="submit">
          Continue
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
      </form>
    </div>

    <div id="backdrop" class="backdrop"></div>

    <?php
      if (!$userIsLoggedIn) {
        echo "<script src='js/script.js'></script>";
      }
    ?>    
    
    <?php
      if ($userIsLoggedIn) {
        echo "<script src='js/userscript.js'></script>";
      }
    ?>
    
    <?php      
      if (isset($_GET["form"])) {
        echo "<script defer>open{$_GET["form"]}FormHandler();</script>";
      }
    ?>
  </body>
</html>
