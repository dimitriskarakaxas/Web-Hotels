<body>
    <header class="top-navigation">
      <p class="logo"><a href="http://localhost/Project/">Web Hotels</a></p>
      <div class="app-actions">
        <?php
          if ($userIsLoggedIn) {
            echo "<div class='dropdown'>
                    <button class='user-greet-btn' id='greet-btn'>Welcome, " . $_SESSION["username"] . "</button>
                    <div id='user-dropdown' class='dropdown-content'>
                      <a href='/Project/src/logout.php'>Log Out</a>
                    </div>
                  </div>";
          } else {
            echo "<button id='login-btn'>Sign In</button>
                  <button id='register-btn'>Register</button>";
          }
        ?>
      </div>
    </header>