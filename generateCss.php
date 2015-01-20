<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include_once './includes/functions.php';
        include_once './includes/db.php';

        $type = filter_input(INPUT_GET, 'type');
        $types = array('locations', 'items');

        if ($type !== NULL && in_array($type, $types)) {



            $output = "";
            $elements = array();
            if ($type == 'locations') {
                $elements = getAllLocations($con);
                $extension = ".jpg";
            } else {
                //type = 'item'
                $elements = getItems($con);
                $extension = ".png";
            }

            foreach ($elements as $row) {
                $output .= "#" . $row["css_id"] . "-location" . " { \n"
                        . "top: " . $row["coordinate_y"] . "px;" . "\n"
                        . "left: " . $row["coordinate_x"] . "px;" . "\n"
                        . "}" . "\n" . "#" . $row["css_id"] . " { \n"
                        . "background: transparent url('../images/$type/"
                        . $row["filename"] . "$extension') no-repeat 0 0;" . "\n" . "}" . "\n";
            }
            $filePath = "./styles/$type.css";

            file_put_contents($filePath, $output);

            echo "Soubor $type.css byl vytvořen jako $filePath";
            ?>
        <br><a href="generateCss.php"> Zpět </a>  
        <?php
    } else {
        if ($type == "") {
            ?>
            <a href="?type=items">Generovat předměty</a><br>
            <a href="?type=locations">Generovat lokace</a><br>
            <br><a href="index.php"> Zpět </a>
            <?php
        } else {
            echo "Nebyl zadán typ nebo se jedná o neznámý typ.";
            ?>
            <br><a href="generateCss.php"> Zpět </a>  
            <?php
        }
    }
    ?>
        