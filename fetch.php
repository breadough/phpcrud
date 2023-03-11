<?php

include 'functions.php';

$id = $_REQUEST['updateId'];

// get the details
$query = new QueryBuilder(
    Connection::make($config['database'])
);

$ulamDetails = $query->selectId($id, 'ulala_table');

// return
echo json_encode($ulamDetails);