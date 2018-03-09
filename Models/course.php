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


	public function __construct(PDO $pdo) {
		$this->pdo=$pdo;
	}

	public function All () // mostra todos os dados da tabela
	{
		$query = " SELECT *FROM { $this->table}";
		$stmt =$this->pdo->prepare($query);
		$stmt=execute();
		$result=$stmt->fetchAll();
		$stmt->CloseCursor();
		return $result;
	}

	public function find($id) //encontra o curso através do id
	{
		$query = "SELECT * FROM {$this->table} WHERE id=:id";
		$stmt =$this->pdo->prepare($query);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result=$stmt->fetch();
		$stmt->CloseCursor();
		return $result;

	}

	public function findByName($name) //encontra o curso através do name
	{
		$query = "SELECT * FROM {$this->table} WHERE name=:name";
		$stmt =$this->pdo->prepare($query);
		$stmt->bindValue(":name",$name);
		$stmt->execute();
		$result=$stmt->fetch();
		$stmt->CloseCursor();
		return $result;

	}

	public function create($id, $name, $type) //adicionando curso
	{
		$query = "INSERT INTO {$this->table}(id,name,type) VALUES (:NULL, :name, :type)";
		$stmt =$this->pdo->prepare($query);
		$stmt->bindValue(":id",$id);
		$stmt->bindValue(":name",$name);
		$stmt->bindValue(":type",$type);
		$result=$stmt->execute();
		$stmt->CloseCursor();
		return $result;

	}

	public function update($id, $name, $type) //atualizando cursos
	{
		$query = "UPDATE {$this->table} SET name=:name, type=:type, WHERE id=:id";
		$stmt =$this->pdo->prepare($query);
		$result=$stmt->execute();
		$stmt->CloseCursor();
		return $result;

	}

	public function delete($id) // excluindo cursos
	{
        $query = "DELETE FROM {$this->table} WHERE id =:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
        
        if ($result) 
        {
            echo "Curso excluído com sucesso";
        }else 
        {
        	echo "Não foi possível excluir o curso";
        }
    }

} 
