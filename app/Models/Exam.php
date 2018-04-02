<?php

    namespace App\Models;

    use PDO;

    class Exam {
        private $pdo;
        protected $table = "exams";
        private $professor;
        private $period;
        private $components_id;
        private $created_at;
        private $unit;
        private $exam_id;
        private $users_id;
        private $image;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function create($professor, $period, $created_at, $components_id, $unit, $users_id, $image){
            $query = "INSERT INTO {$this->table} VALUES (NULL, :professor, :period, :created_at, '1', :components_id, :unit, :users_id, :image)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":professor", $professor);
            $stmt->bindValue(":period", $period);
            $stmt->bindValue(":created_at", $created_at);
            $stmt->bindValue(":components_id", $components_id);
            $stmt->bindValue(":unit", $unit);
            $stmt->bindValue(":users_id", $users_id);
            $stmt->bindValue(":image", $image);
            $result = $stmt->execute();
            $stmt->closeCursor();
            return $result;
        }

        public function all(){
            $query = "SELECT {$this->table}.id, {$this->table}.professor, {$this->table}.period, {$this->table}.created_at, {$this->table}.status, {$this->table}.unit, {$this->table}.image, users.id as creator_id, users.name as created_by, components.code, components.name FROM exams JOIN users on users_id = users.id JOIN components on components_id = components.id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        }
        public function readMostRecent(){
            $query = "SELECT * FROM {$this->table} ORDER BY period DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        }
        public function readLeastRecent(){
            $query = "SELECT * FROM {$this->table} ORDER BY period ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        }
        public function readByComponent($components_id){
            $query = "SELECT * FROM {$this->table} WHERE components_id = :components_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":components_id", $components_id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        }
        public function readSingle($exam_id){
            $query = "SELECT {$this->table}.id, {$this->table}.professor, {$this->table}.period, {$this->table}.created_at, {$this->table}.status, {$this->table}.unit, {$this->table}.image, users.id as creator_id, users.name as created_by, components.code, components.name FROM {$this->table} JOIN users on users_id = users.id JOIN components on components_id = components.id WHERE exams.id = :exam_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":exam_id", $exam_id);
            $stmt->execute();
            $result = $stmt->fetch();
            $stmt->closeCursor();
            return $result;
        }

        public function update($exam_id, $professor, $period, $components_id, $unit){
            $query = "UPDATE {$this->table} SET professor = :professor, period = :period, components_id = :components_id, unit = :unit WHERE id = :exam_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":professor", $professor);
            $stmt->bindValue(":period", $period);
            $stmt->bindValue(":components_id", $components_id);
            $stmt->bindValue(":unit", $unit);
            $stmt->bindValue(":exam_id", $exam_id);
            $result = $stmt->execute();
            $stmt->closeCursor();
            return $result;
        }

        public function deleteExam($exam_id){
            $query = "DELETE FROM {$this->table} WHERE id = :exam_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":exam_id", $exam_id);
            $result = $stmt->execute();
            $stmt->closeCursor();
            return $result;
        }
    }