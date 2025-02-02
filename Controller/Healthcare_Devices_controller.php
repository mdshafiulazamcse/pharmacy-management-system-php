<?php
// Include the model
include_once '../model/Healthcare_Devices_model.php';

// Get filter parameters
$minPrice = isset($_GET['min_price']) && $_GET['min_price'] !== '' ? floatval($_GET['min_price']) : null;
$maxPrice = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? floatval($_GET['max_price']) : null;
$minRating = isset($_GET['rating']) && $_GET['rating'] !== '' ? floatval($_GET['rating']) : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
$viewMode = isset($_GET['view']) ? $_GET['view'] : 'grid';

// Get filtered devices
$devices = getDevices($conn, $minPrice, $maxPrice, $minRating, $sort);

// Include the view to display the data
include_once '../view/Healthcare_Devices_view.php';
?>
