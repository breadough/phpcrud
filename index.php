<?php

include 'functions.php';

$query = new QueryBuilder(
    Connection::make($config['database'])
);

$data_ulam = $query->selectAll('ulala_table');

$indexArray = array();

foreach($data_ulam as $ulam){
    array_push($indexArray, $ulam->id);
}

//
$query = new QueryBuilder(
    Connection::make($config['database'])
);

$data_shop = $query->selectAll('shop_table');
require 'index.view.php';

?>