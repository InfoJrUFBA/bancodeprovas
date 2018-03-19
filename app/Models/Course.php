<?php

namespace App\Models;

use PDO;

class Course
{
	private $pdo;
	protected $table = "courses";
	private $id;
	private $name;
	private $type;
	private $areas_id;


	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}


	public function create($name, $type, $areas_id) //adicionando curso
	{
		$query = "INSERT INTO {$this->table} (name, type, areas_id) VALUES ('{$name}', {$type}, {$areas_id})";
		$stmt = $this->pdo->prepare($query);
		$result = $stmt->execute();
		$stmt->CloseCursor();
		return $result;
	}

	public function all () // mostrando todos os dados da tabela
	{
		$query = "SELECT * FROM {$this->table}";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->CloseCursor();
		return $result;
	}

	public function findById($id) //encontrando o curso através do id
	{
		$query = "SELECT * FROM {$this->table} WHERE id=:id";
		$stmt =$this->pdo->prepare($query);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
	}

	public function findByName($name) //encontrando o curso através do name
	{
		$query = "SELECT * FROM {$this->table} WHERE name=:name";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":name",$name);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
	}

	public function update($id, $name, $type, $areas_id) //atualizando cursos
	{
		$query = "UPDATE {$this->table} SET name=:name, type=:type, areas_id=:areas_id WHERE id=:id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id",$id);
		$stmt->bindValue(":name",$name);
		$stmt->bindValue(":type",$type);
		$stmt->bindValue(":areas_id",$areas_id);
		$result = $stmt->execute();
		$stmt->CloseCursor();
		return $result;
	}

	public function delete($id) // excluindo cursos
	{
        $query = "DELETE FROM {$this->table} WHERE id =:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
}