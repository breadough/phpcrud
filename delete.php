<?php

include 'functions.php';

$id = $_REQUEST['deleteId'];

// get the file path using id and delete
$query = new QueryBuilder(
    Connection::make($config['database'])
);

$file_name = $query->selectId($id, 'ulala_table');
$location_with_file_name = "img/"."$file_name->imagepath";
$delete = unlink($location_with_file_name);

// delete record on DB
$query = new QueryBuilder(
    Connection::make($config['database'])
);

$query->deleteUlam($id, 'ulala_table');

// return
echo json_encode("success");