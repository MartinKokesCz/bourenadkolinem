<?php
include_once 'includes/header.php';

$idItem = @$_GET['idItem'];


$item = getItem($con, $idItem);

echo @$item['name'] . "<br>"; 
echo @$item['description'];
?>
<br>
<a href="location.php?idLocation=<?php echo $item['id_location']; ?>">Zpět</a>
<?php
include 'includes/footer.php';
?>