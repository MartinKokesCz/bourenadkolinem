<?php

include_once 'db.php';

function getMap($connection, $idMap = FALSE) {
    $query = "SELECT * FROM maps WHERE id_map= $idMap;";
    $result = mysqli_query($connection, $query);
    @$row = mysqli_fetch_array($result);
    return $row;
}

function getAllLocations($connection, $idMap = FALSE) {
    $query = "SELECT * FROM location";
    if ($idMap != FALSE) {
        $query .= " WHERE id_map= $idMap;";
    } else {
        $query .= ";";
    }

    $result = mysqli_query($connection, $query);
    $locations = array();
    while ($row = mysqli_fetch_array($result)) {
        $locations[] = $row;
    }
    return $locations;
}

function getLocation($connection, $idLocation) {
    $query = "SELECT * FROM location WHERE id= $idLocation;";
    $result = mysqli_query($connection, $query);
    $location = mysqli_fetch_array($result);
    return $location;
}

function getItems($connection, $idLocation = FALSE, $inventoryItems = FALSE) {
    $query = "SELECT * FROM item";

    if ($idLocation != FALSE) {
        $query .= " WHERE id_location= $idLocation";
    }

    if ($inventoryItems !== FALSE && count($inventoryItems) > 0) {
        $query .= " AND id_item NOT IN ('" . implode($inventoryItems, "', '") . "' )";
    }
    $result = mysqli_query($connection, $query);
    $items = array();
    while ($row = mysqli_fetch_array($result)) {
        $items[] = $row;
    }
    return $items;
}

function getItem($connection, $idItem) {
    $query = "SELECT * FROM item WHERE id_item= $idItem;";
    $result = mysqli_query($connection, $query);
    $item = mysqli_fetch_array($result);
    return $item;
}
