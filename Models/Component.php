<?php
namespace App\Models;

use PDO;

class Component
{
	private $pdo;
	protected $table = "component";
	private $id;
	private $name;


	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function create($name) {
		$query = "INSERT INTO {$this->table} (name,type) VALUES (:name)";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":name", $name);
		$result = $stmt->execute();
		$stmt->CloseCursor();
		return $result;
	}

	public function readAll() {
		$query = "SELECT * FROM {$this->table}";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
    }
	public function readById() {
		$query = "SELECT * FROM {$this->table} WHERE id=:id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
    }
} 
