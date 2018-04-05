<?php
namespace App\Models;

use PDO;

class Component {
	private $pdo;
	protected $table = "components";
	private $id;
	private $code;
	private $name;

	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function create($code, $name) {
		$query = "INSERT INTO {$this->table} (code, name) VALUES (:code, :name)";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":code", $code);
		$stmt->bindValue(":name", $name);
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
		$query = "SELECT * FROM {$this->table} WHERE id = :id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->CloseCursor();
		return $result;
	}
	public function readByCourse($courses_id) {
		$query = "
		SELECT {$this->table}.id, {$this->table}.code, {$this->table}.name FROM {$this->table}
		JOIN courses_has_components chasc ON components.id = chasc.components_id 
		JOIN courses ON courses.id = chasc.courses_id 
		WHERE chasc.courses_id = :courses_id";

		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":courses_id", $courses_id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->CloseCursor();
		return $result;
	}
	
	public function update($id, $code, $name) {
		$query = "UPDATE {$this->table} SET code=:code, name=:name WHERE id=:id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->bindValue(":code", $code);
		$stmt->bindValue(":name", $name);
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
