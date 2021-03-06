<?php
    if (strlen($product['StockItemName']) < 1) {
        // Check if a product is selected, if not print error message
        print('<div class="alert alert-danger" role="alert">Er is geen product geselecteerd!</div>');
    } else {
        ?>
        <div class='row'>
            <div class='col-md-3'>
                <!--<div class='card'>-->
                    <div id="carouselWithControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            for($i = 0; $i < count($pictures); $i++){
                                if($i == 0){
                                    print("<div class = 'carousel-item active'>");
                                }   
                                else{
                                    print("<div class = 'carousel-item'>");
                                }
                            $image = $pictures[$i][0];
                            (strlen($image) < 1 ?
                            print("<img class='d-block w-100' src='img/image_not_found.png' alt='Slide'>"):    
                            print("<img class='d-block w-100' src='data:image/gif;base64,".base64_encode($image)."' alt='slide". $i ."'>"));
                            print("</div>");
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselWithControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselWithControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                <!--</div>-->
            </div>
            <div class='col-md-5'>
                <div class='card'>
                    <div class='card-header'>
                        <strong><?php print($product['StockItemName']); ?></strong>
                    </div>
                    <div class='card-body'>
                        <h6 class='card-subtitle mb-2'>
                            Prijs: &euro;<?php print($product['UnitPrice']); ?>
                        </h6>
                        <p class='card-text'>
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                            (strlen($product['MarketingComments']) < 1 ? "":print("Opmerkingen: </td><td>".$product['MarketingComments']));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            print("Voorraad: </td><td>".(strlen($product['QuantityOnHand']) < 1 ? "Geen voorraad":$product['QuantityOnHand']));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            (strlen($product['Tags']) < 3 ? "":print("Tags: </td><td>". str_replace(['[',']','"'],'',str_replace(',',', ',$product['Tags']))));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            print($product['ColorID'] == 0 ? "":"Kleur: </td><td>".$product['ColorName']);
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </p>
                        <form method='post' action='f_handler.php?form_handler=f_add_to_basket.php'>
                            <div class="input-group mb-3">
                                <input type='hidden' id='<?php print($product['StockItemID']); ?>' name='itemID' value='<?php print($product['StockItemID']); ?>'>
                                <input style='float: left;' class='form-control col-md-4' type='number' name='itemAmount' id='itemAmount' min='1' max='<?php print($product['QuantityOnHand']); ?>' value='1'>
                                <div class="input-group-append">
                                    <button style='float: left;' class='btn btn-primary btn-block input-group-text' type='submit'>
                                        <span class='fa fa-cart-plus'></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }
?>
