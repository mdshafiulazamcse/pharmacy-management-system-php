<?php
session_start();
require_once '../Model/over_the_counter_model.php';

if (isset($_GET['q'])) {
    $query = trim($_GET['q']);
    $products = searchProducts($query);
} else {
    $products = [];
}

include('../View/search_results.php');
