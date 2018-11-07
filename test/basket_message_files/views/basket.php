<div class="row">
    <div class="col-md-10">
        <?php 
        // Noty uses this div to display messages
        echo '<div class="notyDiv" style="position: fixed; right: 40px; z-index: 9999;"></div>';
        if(isset($_COOKIE['basket'])) {
            //if cookie 'basket' exists, run this code
            echo "<h3>Winkelwagen</h3>";
        }
        ?>
        <div class="row">
            <?php
            if(isset($_COOKIE['basket'])) {
                //Turn cookie into array
                $basket = json_decode($_COOKIE['basket'], true);
                //Variable for the total price
                $totalPrice = 0;
                foreach ($basket as $key => $value) {
                    //print the products from the basket array
                    $data = $db->prepare("SELECT StockItemName, Size, Photo, UnitPrice FROM Stockitems WHERE StockItemID = ($key)");
                    $data->execute();
                    $data = $data->fetch();
                    
                    //Show product name and picture
                    print("<div class='col-md-3'>");
                    print("<h5>".$data['StockItemName']."</h5>");
                    print(strlen($data['Photo']) < 1 ? "<img class='card-img-top' src='img/image_not_found.png' />":"<img class='card-img-top' src='data:image/gif;base64,".base64_encode($data['Photo'])."'/>");
                    
                    if (!empty($data['Size'])) {
                        //Check if Size has a value
                        print("Grootte: " . $data['Size']);
                    } else {
                        print("Geen grootte");
                    }
                    //Change amount of products with confirm button
                    ?>
                    <form method="post" action='f_change_amount_basket.php'>
                        <input class="form-control" type="number" <?php print("name='" . $key . "'") ?> value="<?php print("$value") ?>" min="1">
                        <input class="btn btn-warning" type="submit" value="Bevestig">
                    </form>
                    <?php
                    //Delete product with a invisible field. Later we can use this field to see which product has been deleted
                    ?>
                    <form method="post" action="f_delete_from_basket.php">
                        <input type="hidden" <?php print("name='" . $key . "'") ?> <?php print("value='" . $basket[$key] . "'")?>>
                        <button class="btn btn-primary" type='submit' <?php print("value='" . $key . "'") ?>>Verwijder product</button>
                    </form>
                    <?php
                    print("<br> Prijs: €" . ($value * $data['UnitPrice']) . "<br><br></div>");
                    //Add price of this item to variable totalprice
                    $totalPrice = $totalPrice + ($value * $data['UnitPrice']);
                }
            } else {
                //This piece of code runs when cookie 'basket' doesn't exist
                ?> 
                <div class="col-md-6 start-shopping text-center mx-auto">
                    <i class="fas fa-shopping-basket"></i>
                    <h3>Uw winkelwagen is leeg</h3>
                    <a class="btn btn-primary" href="index.php">Winkelen</a>
                </div>
                <?php
            }    
            ?>
        </div>
    </div>
    <div class="col-md-2">
        <?php 
            if (isset($_COOKIE['basket'])) {
                print("<p> Totale prijs: €".$totalPrice."</p>"); 
                ?> 
                <form action="f_placeorder.php" method="post">
                    <input class="btn btn-primary" type="submit" value="Plaatsen">
                </form>
                <?php
            }
        ?>
    </div>
</div>