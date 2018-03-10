<?php
namespace App\Models;

use PDO;

class Component
{
	private $pdo;
	protected $table = "components";
	private $id;
	private $name;


	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function create($name) {
		$query = "INSERT INTO {$this->table} (name) VALUES ('{$name}')";
		$stmt = $this->pdo->prepare($query);
		$result = $stmt->execute();
		$stmt->CloseCursor();
		return $result;
	}

	public function readAll() {
		$query = "SELECT * FROM {$this->table}";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->CloseCursor();
		return $result;
    }
	public function readById($id) {
		$query = "SELECT * FROM {$this->table} WHERE id= {$id}";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
	}
	
	public function update($id, $name) {
		$query = "UPDATE {$this->table} SET name = '{$name}' WHERE id = {$id}";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
	}

	public function delete($id) {
		$query = "DELETE FROM {$this->table} WHERE id = {$id}";
		$stmt = $this->pdo->prepare($query);
		$result = $stmt->execute();
		$stmt->CloseCursor();
		return $result;
	}
} 
