<?php
include 'functions.php';

$name = $_POST['shop_name'];
$location = $_POST['shop_location'];
$website = $_POST['shop_website'];

$query = new QueryBuilderShop(
    Connection::make($config['database'])
);
$query->insertShop('shop_table', $name, $location, $website);
header('location: /');