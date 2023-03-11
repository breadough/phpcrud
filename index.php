<?php

include 'functions.php';

$query = new QueryBuilder(
    Connection::make($config['database'])
);

$data = $query->selectAll('ulala_table');

require 'index.view.php';


?>