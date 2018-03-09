<?php

namespace App\Models;

use PDO;

class Users {
    private $pdo;
    protected $table = "users";
    private $id;
    private $name;
    private $email;
    private $password;
    private $image;
    private $score;
    private $birthdate;
    private $level;
    private $courses_id;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function All () { //Mostra todos os usuários
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function findById($id) { // Procura usuário pelo id
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function findByName($name) { // Procura usuário pelo nome
        $query = "SELECT * FROM {$this->table} WHERE name=:name";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function findByCourse($courses_id) { // Procura usuário pelo id do curso
        $query = "SELECT * FROM {$this->table} WHERE courses_id=:courses_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function create($id, $name, $email, $password, $image, $score, $birthdate, $level, $courses_id) { //criando usuário
        $query = "INSERT INTO {$this->table}(id, name, email, password, image, score, birthdate, level, courses_id) VALUES (:NULL, :name, :name, :email, :password, :image, :score, :birthdate, :level, :courses_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":image", $image);
        $stmt->bindValue(":score", $score);
        $stmt->bindValue(":birthdate", $birthdate);
        $stmt->bindValue(":level", $level);
        $stmt->bindValue(":courses_id", $courses_id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    public function update($id, $name, $email, $password, $image, $score, $birthdate, $level, $courses_id) { //atualizando o usuário
        $query = "UPDATE {$this->table} SET name=:name, email=:email, password=:password, image=:image, score=:score, birthdate=:birthdate, level=:level, WHERE id=:id, courses_id=:courses_id";
        $stmt =$this->pdo->prepare($query);
        $result=$stmt->execute();
        $stmt->CloseCursor();
        return $result;
    }

    public function delete($id) { //excluindo usuário
        $query = "DELETE FROM {$this->table} WHERE id =:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;

        if ($result) {
            echo "Curso excluído com sucesso";
        } else {
            echo "Não foi possível excluir o curso";
        }
    }
}