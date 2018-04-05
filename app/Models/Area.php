<?php

namespace App\Models;

use PDO;

class Area {
	private $pdo;
	protected $table = "areas";
	private $id;
	private $name;

	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function create($name) {
		$query = "INSERT INTO {$this->table} (id,name) VALUES (NULL, :name)";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":name", $name);
		$result = $stmt->execute();
		$stmt->CloseCursor();
		return $result;
	}

	public function all () {
		$query = "SELECT * FROM {$this->table}";
		$stmt = $this->pdo->prepare($query);
		$stmt -> execute();
		$result = $stmt->fetchAll();
		$stmt->CloseCursor();
		return $result;
	}

	public function findById($id) {
		$query = "SELECT {$this->table}.id, {$this->table}.name, courses.id as courses_id, courses.name as courses_name, courses.type as courses_type, courses.areas_id FROM {$this->table} JOIN `courses` WHERE {$this->table}.id = :id AND courses.areas_id = :id";
		"SELECT * FROM {$this->table} WHERE id=:id";
		$stmt =$this->pdo->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->CloseCursor();
		return $result;
	}

	public function findByName($name) {
		$query = "SELECT * FROM {$this->table} WHERE name=:name";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":name", $name);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
	}

	public function update($id, $name) {
		$query = "UPDATE {$this->table} SET name=:name WHERE id=:id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->bindValue(":name", $name);
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
