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

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function createExam($professor, $period, $created_at, $components_id, $unit){
            $query = "INSERT INTO {$this->table} VALUES (NULL, '{$professor}', '{$period}', '{$created_at}', '1', '{$components_id}', '{$unit}')";
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $stmt->closeCursor();
            return $result;
        }

        public function all(){
            $query = "SELECT * FROM {$this->table}";
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
            $query = "SELECT * FROM {$this->table} WHERE components_id = $components_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        }
        public function readSingle($exam_id){
            $query = "SELECT * FROM {$this->table} WHERE id = $exam_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch();
            $stmt->closeCursor();
            return $result;
        }

        public function update($exam_id, $professor, $period, $components_id, $unit){
            $query = "UPDATE {$this->table} SET professor = '{$professor}', period = '{$period}', components_id = '{$components_id}', unit = '{$unit}' WHERE id = $exam_id";
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $stmt->closeCursor();

            if ($result) {
                echo "Atualização sucedida";
            }else {
                echo "Não foi possível atualizar";
            }
            return $result;
        }

        public function deleteExam($exam_id){
            $query = "DELETE FROM {$this->table} WHERE id = $exam_id";
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $stmt->closeCursor();

            if ($result) {
                echo "Prova excluída com sucesso";
            }else {
                echo "Não foi possível excluir";
            }
            return $result;
        }

    }
