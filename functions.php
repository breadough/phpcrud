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

    public function selectById($table, $id)
    {
        $statement = $this->pdo->prepare("select * from {$table} where id = {$id}");
		$statement->execute();
		return $statement->fetch(PDO::FETCH_OBJ);
	}

    public function deleteById($table, $id)
    {
		$statement = $this->pdo->prepare("delete from {$table} where id = {$id}");
        $statement->execute();
    }

}
  
class QueryBuilderUlam extends QueryBuilder{
    
    public function insertUlam($table, $name, $description, $imagepath)
    {
        $sql = "insert into {$table}(`name`, `description`, `imagepath`) VALUES( :name, :description, :imagepath )";
		$statement = $this->pdo->prepare($sql);
		$statement->execute([':name'=>$name, ':description'=>$description, ':imagepath'=>$imagepath]);
    }

    public function updateUlamById($table, $id, $name, $description){
        $sql = "update {$table} set name=:name, description=:description where id = {$id}";
		$statement = $this->pdo->prepare($sql);
		$statement->execute([':name'=>$name, ':description'=>$description]);
    }
}

class QueryBuilderShop extends QueryBuilder{
    
    public function insertShop($table, $name, $location, $website)
    {
        $sql = "insert into {$table}(`name`, `location`, `website`) VALUES( :name, :location, :website )";
		$statement = $this->pdo->prepare($sql);
		$statement->execute([':name'=>$name, ':location'=>$location, ':website'=>$website]);
    }

    public function updateShopById($table, $id, $name, $location, $website)
    {
        $sql = "update into set name=:name, location=:location, website=:website where id = {$id}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':name'=>$name, ':location'=>$location, ':website'=>$website]);
    }
}