<?php

    namespace App\Models;

    use PDO;

    class Exam{
        private $pdo;
        protected $table = "exams";
        private $professor;
        private $semester;
        private $component;
        private $time;
        private $unit;
        private $exam_id;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function createExam($professor, $semester, $time, $component, $unit){
            $query = "INSERT INTO {$this->table} VALUES (NULL, '{$professor}', '{$semester}', '{$time}', '1', '{$component}', '{$unit}')";
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $stmt->closeCursor();
            return $result;
        }

        public function readAll(){
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
        public function readByComponent($component_id){
            $query = "SELECT * FROM {$this->table} WHERE components_id = $component_id";
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
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        }

        public function update($exam_id, $professor, $semester, $component_id, $unit){
            $query = "UPDATE {$this->table} SET professor = '{$professor}', period = '{$semester}', components_id = '{$component_id}', unit = '{$unit}' WHERE id = $exam_id";
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $stmt->closeCursor();
            return $result;

            if ($result) {
                echo "Atualização sucedida";
            }else {
                echo "Não foi possível atualizar";
            }
        }

        public function deleteExam($exam_id){
            $query = "DELETE FROM {$this->table} WHERE id = $exam_id";
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $stmt->closeCursor();
            return $result;

            if ($result) {
                echo "Prova excluída com sucesso";
            }else {
                echo "Não foi possível excluir";
            }
        }

    }
