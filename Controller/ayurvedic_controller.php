<?php
require_once '../Model/ayurvedic_model.php';

// Get filter parameters
$categories = isset($_GET['categories']) ? $_GET['categories'] : [];
$brands = isset($_GET['brands']) ? $_GET['brands'] : [];
$minPrice = isset($_GET['min_price']) && $_GET['min_price'] !== '' ? floatval($_GET['min_price']) : null;
$maxPrice = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? floatval($_GET['max_price']) : null;
$minRating = isset($_GET['rating']) && $_GET['rating'] !== '' ? floatval($_GET['rating']) : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
$viewMode = isset($_GET['view']) ? $_GET['view'] : 'grid';

// Get available categories and brands
$categories_list = getCategories($conn);
$brands_list = getBrands($conn);

// Get filtered products
$products = getProducts($conn, $categories, $brands, $minPrice, $maxPrice, $minRating, $sort);
include('../View/ayurvedic_view.php');


?>
