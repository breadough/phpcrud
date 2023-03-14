<?php

include 'functions.php';

$id = $_POST['ulam_id'];
$name = $_POST['ulam_name'];
$description = $_POST['ulam_description'];


$query = new QueryBuilderUlam(
    Connection::make($config['database'])
);

$query->updateUlamById('ulala_table', $id, $name, $description);

header('location: /');