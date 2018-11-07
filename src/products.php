<?php
require('inc/config.php');

// title variable (used in template)
$title = "Producten";

// lege sql variabele die later ingevuld wordt
$sql = '';
$order = isSet($_GET['order']) ? $_GET['order'] : 'ASC';
// kijkt of er gezocht is of dat de productenpagina gewoon bezocht wordt en geeft een query ob basis hiervan
if(isSet($_GET['search'])) {
  // resultaat uit de URL
  $request = $_GET['search'];
  $sql = 'SELECT * FROM stockitems WHERE SearchDetails LIKE "%'.$request.'%"';
} else if(isSet($_GET['filter'])){
  $request = $_GET['filter'];
  if ($_GET['filter'] == "Clothing") {
    $title = "Kleren";
  } elseif ($_GET['filter'] == "Toys") {
    $title = "Speelgoed";
  } elseif ($_GET['filter'] == "Novelty Items") {
    $title = "Snufjes";
  } elseif ($_GET['filter'] == "Packaging Materials") {
    $title = "Verpakking";
  }
  if($request === 'Clothing') {
    $sql = 'SELECT * FROM stockitems si JOIN stockitemstockgroups sisg ON sisg.StockItemID = si.StockItemID JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID WHERE sg.StockGroupName = "Clothing" OR sg.StockGroupName = "Furry Footwear" OR sg.StockGroupName = "T-Shirts" ORDER BY si.UnitPrice '.$order.'';
  } else {
    $sql = 'SELECT * FROM stockitems si JOIN stockitemstockgroups sisg ON sisg.StockItemID = si.StockItemID JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID WHERE sg.StockGroupName LIKE "%'.$request.'%" ORDER BY si.UnitPrice '.$order.'';
  }
} else {
  if(isSet($_GET['order'])) {
    $prevURL = $_SERVER['HTTP_REFERER'];
    $request = substr($prevURL, strpos($prevURL, '=') + 1);
    $sql = 'SELECT * FROM stockitems si JOIN stockitemstockgroups sisg ON sisg.StockItemID = si.StockItemID JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID WHERE sg.StockGroupName LIKE "%'.$request.'%" ORDER BY si.UnitPrice '.$order.'';
  } else {
    $sql = 'SELECT StockItemID, StockItemName, Photo, UnitPrice FROM stockitems LIMIT 0, 18';
  }
}
// lege array die later gevuld wordt
$arrayProducts = array();

// query wordt voorbereid
$query = $db->prepare($sql);

// query wordt uitgevoerd, aantal resultaten worden geteld en als dit niet 0 is
// gaat hij de resultaten in de lege array hierboven zetten. In de views laat hij deze zien
if($query->execute()) {
  $rowCount = $query->rowCount();
  if($rowCount !== 0) {
    while($products = $query->fetch()) {
        array_push($arrayProducts, $products);
    }
  }
}

$view = "products.php";
include_once $template;
?>
