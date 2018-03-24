<?php
namespace App\Models;

use PDO;

class Component
{
	private $pdo;
	protected $table = "components";
	private $id;
	private $code;
	private $name;

	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function create($code, $name) {
		$query = "INSERT INTO {$this->table} (code, name) VALUES ('{$code}', '{$name}')";
		$stmt = $this->pdo->prepare($query);
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
	public function readById($id) {
		$query = "SELECT * FROM {$this->table} WHERE id= {$id}";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
	}
	
	public function update($id, $code, $name) {
		$query = "UPDATE {$this->table} SET code='{$code}', name='{$name}' WHERE id = {$id}";
		$stmt = $this->pdo->prepare($query);
		$result = $stmt->execute();
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
