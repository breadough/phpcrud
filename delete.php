<?php

include 'functions.php';

$id = $_REQUEST['deleteId'];

// get the file path using id and delete
$query = new QueryBuilder(
    Connection::make($config['database'])
);

$file_name = $query->selectById('ulala_table', $id);
$location_with_file_name = "img/"."$file_name->imagepath";
$delete = unlink($location_with_file_name);

// delete record on DB
$query = new QueryBuilder(
    Connection::make($config['database'])
);

$query->deleteById('ulala_table', $id);

// return
echo json_encode("success");