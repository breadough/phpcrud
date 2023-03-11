<?php

include 'functions.php';

$query = new QueryBuilder(
    Connection::make($config['database'])
);

$data = $query->selectAll('ulala_table');

$indexArray = array();

foreach($data as $ulam){
    array_push($indexArray, $ulam->id);
}

require 'index.view.php';

?>