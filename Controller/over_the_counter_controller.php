<?php
// product_controller.php

require_once '../Model/over_the_counter_model.php';

// Get parameters from URL
$category = isset($_GET['category']) ? $_GET['category'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : null;

// Fetch products
$products = getProducts($category, $sort);

// Insert products (optional: triggered by some event, form submission, etc.)
// insertProduct("Aspirin", "Pain reliever", 5.99, "Pain Relief");
// insertProduct("Paracetamol", "Fever and pain relief", 3.49, "Pain Relief");

// Include the view to display products
include('../View/over_the_counter_view.php');
?>
