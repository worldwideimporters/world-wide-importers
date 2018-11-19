<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php">World Wide Importers</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <?php
            // Add new pages in array, "filename.php" => "Name",
            $pages = array(
              "login.php" => "Login",
              "products.php" => "Producten",
              "register.php" => "Register",
            );

            // For every page defined in $pages array, add to navigation
            foreach ($pages as $key => $value) {
              print("<li class='nav-item active'>
                  <a class='nav-link' href='$key'>$value</a>
              </li>");
            }
          ?>
            <!-- <li class="nav-item active">
                <a class="nav-link" href="test.php">Test</a>
            </li> -->
            <?php
                if(!isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] == false)) {

                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='profile.php'>Profiel</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
                };
            ?>
        </ul>
        <form action="products.php" method="get" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>