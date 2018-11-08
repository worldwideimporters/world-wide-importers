<div style="margin-top: 0; margin-left: 0; color: red; background-color: black; z-index: 9999;">
    Dit is een school project!
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">World Wide Importers</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <?php
                // Add new pages in array, "filename.php" => "Name",
                $pages = array(
                    "products.php?filter=Clothing" => "Kleren",
                    "products.php?filter=Novelty Items" => "Snufjes",
                    "products.php?filter=Toys" => "Speelgoed",
                    "products.php?filter=Packaging Materials" => "Verpakking",
                    //"basket.php" => "<i class='fas fa-shopping-basket basket'></i>",
                );

                // For every page defined in $pages array, add to navigation
                foreach ($pages as $key => $value) {
                    print("<li class='nav-item ".($title == $value ? "active":"")."'>
                            <a class='nav-link' href='$key'>$value</a>
                        </li>");
                }
            ?>
            </ul>
            <form action="products.php" method="get" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Zoeken" aria-label="Zoeken">
                <div>
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Zoek</button>
                    <a class="btn btn-primary my-2 my-sm-0 basketBtn <?php print($title == "Winkelwagen" ? "basketActive":""); ?>" href="basket.php"><i class="fas fa-shopping-basket basket"></i></a>
                </div>
            </form>

            <?php
                // Checks if user is logged in or not.
                if(!isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] == false)) {
                    echo "<a class='btn btn-primary my-2 my-sm-0 basketBtn".($title == 'Login' ? 'basketActive':'')."' href='login.php'><i class='fas fa-sign-in-alt basket'></i></a></li>";
                    //echo "<a class='btn btn-primary my-2 my-sm-0 basketBtn".($title == 'Registreer' ? 'basketActive':'')."' href='register.php'><i class='fas fa-user basket'></i></a></li>";
                } else {
                    echo "<a class='btn btn-primary my-2 my-sm-0 basketBtn".($title == 'Profiel' ? 'basketActive':'')."' href='profile.php'><i class='fas fa-user basket'></i></a></li>";
                    echo "<a class='btn btn-primary my-2 my-sm-0 basketBtn".($title == 'Uitloggen' ? 'basketActive':'')."' href='logout.php'><i class='fas fa-sign-out-alt basket'></i></a></li>";
                };
            ?>

        </div>
    </div>
</nav>
