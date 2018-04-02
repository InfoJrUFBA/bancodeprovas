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

	public function replaceToType($course) {
		foreach ($course as $c):
			$type = ($c->type == 1) ? "Bacharelado" : "Pós-Graduação";
			$c->type = $type;
		endforeach;
		return $course;
	}

	public function create($name, $type, $areas_id) //adicionando curso
	{
		$query = "INSERT INTO {$this->table} (name, type, areas_id) VALUES (:name, :type, :areas_id)";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":name", $name);
		$stmt->bindValue(":type", $type);
		$stmt->bindValue(":areas_id", $areas_id);
		$result = $stmt->execute();
		$stmt->CloseCursor();
		return $result;
	}

	public function all() {
		$query = "SELECT * FROM {$this->table}";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->CloseCursor();
		return $result;
	}

	public function findById($id) {
		$query = "SELECT * FROM {$this->table} WHERE id=:id";
		$stmt =$this->pdo->prepare($query);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $this->replaceToType($result);
	}

	public function findByName($name) {
		$query = "SELECT * FROM {$this->table} WHERE name=:name";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":name",$name);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $this->replaceToType($result);
	}

	public function findByArea($areas_id) {
		$query = "SELECT {$this->table}.id, {$this->table}.name, {$this->table}.type, areas.name AS area FROM {$this->table} JOIN areas ON courses.areas_id = areas.id WHERE areas_id=:areas_id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":areas_id",$areas_id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->CloseCursor();
		return $this->replaceToType($result);
	}

	public function update($id, $name, $type, $areas_id) {
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

	public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id =:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
}