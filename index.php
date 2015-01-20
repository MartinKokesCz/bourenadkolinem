<!DOCTYPE html>

<?php
include_once 'includes/header.php';
include_once 'includes/session.php';


$idMap = @$_GET['id_map'];
//$idMap = filter_input(INPUT_GET, 'id_map');
$myLocations = getAllLocations($con, $idMap);

if (!isset($idMap)) {
    $idMap = 1;
}

$myMap = getMap($con, $idMap);
?>



<div id="viewer" class="viewer no-select">

    


    <?php /* if ($myMap['id_north_map'] != NULL) { ?>
      <a href='?id_map=<?php echo $myMap['id_north_map'] ?>' class='arrow' id='arrow-north'>^</a>
      <?php
      }
      if ($myMap['id_east_map'] != NULL) {
      ?>
      <a href='?id_map=<?php echo $myMap['id_east_map'] ?>' class='arrow' id='arrow-east'>&gt;</a>
      <?php
      }
      if ($myMap['id_south_map'] != NULL) {
      ?>
      <a href='?id_map=<?php echo $myMap['id_south_map'] ?>' class='arrow' id='arrow-south'>v</a>
      <?php
      }
      if ($myMap['id_west_map'] != NULL) {
      ?>
      <a href='?id_map=<?php echo $myMap['id_west_map'] ?>' class='arrow' id='arrow-west'>&lt;</a>
      <?php
      } */
    ?>
    <!--<h1><?php echo @$myMap['name']; ?> </h1>-->
    <?php
    foreach ($myLocations as $row) {
        ?> 

        <a href="location.php?idLocation=<?php echo $row['id']; ?>" class="location" id="<?php echo $row['css_id']; ?>-location">
            <img src='images/location/domecek.png' alt='<?php echo $row["name"]; ?>'/>
        </a>

        <?php
    }
    ?>
<img src="images/photo.jpg" alt="" draggable="false" id="photo">
</div>

<script src="js/RequestAnimationFrame.js"></script>
<script src="js/TouchScroll.js"></script>


<script>
    var viewer = new TouchScroll();
    viewer.init({
        id: 'viewer',
        draggable: true,
        wait: false
    });
</script>

<?php
include 'includes/footer.php';
?>
