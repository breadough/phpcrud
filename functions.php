<?php

$config = require 'config.php';

class Connection
{
    public static function make($config)
    {
        try {
            return new PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

class QueryBuilder
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectId($id, $table)
    {
        $statement = $this->pdo->prepare("select * from {$table} where id = {$id}");
		$statement->execute();
		return $statement->fetch(PDO::FETCH_OBJ);
	}

    public function addUlam($name, $description, $imagepath)
    {
        $sql = "insert into `ulala_table`(`name`, `description`, `imagepath`) VALUES( :name, :description, :imagepath )";
		$statement = $this->pdo->prepare($sql);
		$statement->execute([':name'=>$name, ':description'=>$description, ':imagepath'=>$imagepath]);
    }

    public function updateId($id, $name, $description, $table){
        $sql = "update {$table} set name=:name, description=:description where id = {$id}";
		$statement = $this->pdo->prepare($sql);
		$statement->execute([':name'=>$name, ':description'=>$description]);
    }

    public function deleteUlam($id, $table)
    {
		$statement = $this->pdo->prepare("delete from {$table} where id = {$id}");
        $statement->execute();
    }
}