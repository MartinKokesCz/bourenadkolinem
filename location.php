<?php
include_once 'includes/header.php';

$useItemId = filter_input(INPUT_GET, 'useItem');

// získání detailů používaného předmětu podle ID
$useItem = getItem($con, $useItemId);
?>

<style>
    .location-screen {
        cursor: url("images/items/<?php echo $useItem['filename']; ?>.png") , auto;
    }
</style>
<?php
session_start();

$inventoryString = $_SESSION['inventory'];
$inventoryItems = explode('|', $inventoryString);




$idLocation = filter_input(INPUT_GET, 'idLocation');

$location = getLocation($con, $idLocation);

$items = getItems($con, $idLocation, $inventoryItems);

$idItem = @$_GET['idItem'];




echo @$location['name'];
?>
<br>
<div class=location-screen id="<?php echo $location['css_id'] ?>"> </div><br>
<?php
if (isset($idItem)) {
    $item = getItem($con, $idItem);
    echo @$item['name'] . "<br>";
    echo @$item['description'];

    if ($item['pick_up'] == 1 && !in_array($idItem, $inventoryItems)) {

        @$_SESSION['inventory'] .= $item['id_item'] . "|";

        $inventoryString = $_SESSION['inventory'];
        $inventoryItems = explode('|', $inventoryString);
        $items = getItems($con, $idLocation, $inventoryItems);
    }
}
?>

<?php
// vykreslení všech itemů v lokaci
foreach ($items as $row) {
    ?> 

    <a href="location.php?idLocation=<?php echo $idLocation; ?>&idItem=<?php echo $row['id_item']; ?>" class="location" id="<?php echo $row['css_id']; ?>-location">
        <img src='images/items/<?php echo $row['filename']; ?>.png' alt='<?php echo $row["name"]; ?>'/>
    </a>

    <?php
}
?>
<br>
Inventář:<br>
<?php
array_pop($inventoryItems);
if ($inventoryString !== NULL) {
    foreach ($inventoryItems as $itemId) {
        $idItem = $itemId;
        $invetory = getItem($con, $idItem);
        ?> 
        <a href="location.php?idLocation=<?php echo $idLocation; ?>&useItem=<?php echo $idItem; ?>">
            <img src="images/items/<?php echo $invetory['filename']; ?>.png" >
        </a>
        <br><br>
        <?php
    }
} else {
    echo "inventář je prázdný";
}
?>

<a href="location.php?idLocation=<?php echo $item['id_location']; ?>">Zpět</a>
<a href="index.php?id_map=<?php echo $location['id_map']; ?>">Zpět</a>
<?php
include 'includes/footer.php';
?>