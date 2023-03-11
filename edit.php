<?php

include 'functions.php';

$id = $_POST['ulam_id'];
$name = $_POST['ulam_name'];
$description = $_POST['ulam_description'];


$query = new QueryBuilder(
    Connection::make($config['database'])
);

$query->updateId($id, $name, $description, 'ulala_table');

header('location: /');