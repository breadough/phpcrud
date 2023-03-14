<?php

include 'functions.php';

$id = $_REQUEST['updateId'];

// get the details
$query = new QueryBuilder(
    Connection::make($config['database'])
);

$ulamDetails = $query->selectById('ulala_table', $id);

// return
echo json_encode($ulamDetails);