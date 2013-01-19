<?php
/*
namespace DAO;

use \PDO,
    model\Atividade,
    DAO\Connection,
    DAO\IAtividadeDAO,
    DAO\Exception,
    DAO\NotFoundException;
*/

require_once(__DIR__ . '/../IAtividadeDAO.php');
require_once(__DIR__.'/../Connection.php');
require_once(__DIR__.'/../Exception.php');
require_once(__DIR__.'/../NotFoundException.php');

class AtividadeDAO implements IAtividadeDAO{
	const SQL_POST = 'INSERT INTO Atividade VALUES(
		DEFAULT,
		:atividade_tipo,
		:atividade_descricao, 
		:atividade_datainicio,
		:atividade_datafim,
		:atividade_professor
		);';
	const SQL_UPDATE = 'UPDATE Atividade SET 
		atividade_tipo = :atividade_tipo,
		atividade_descricao = :atividade_descricao, 
		atividade_datainicio = :atividade_datainicio,
		atividade_datafim = :atividade_datafim,
		atividade_professor = :atividade_professor
		WHERE atividade_id = :atividade_id;';
	const SQL_GET = 'SELECT * FROM Atividade WHERE atividade_id = :atividade_id;';
	const SQL_GET_ALL = 'SELECT * FROM Atividade;';
	const SQL_DELETE = 'DELETE FROM Atividade WHERE atividade_id = :atividade_id;';

	public function post(Atividade $ativ){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':atividade_tipo' =>$ativ->getTipo(),
                ':atividade_descricao' =>$ativ->getDescricao(),
                ':atividade_datainicio' =>$ativ->getDataInicio(),
                ':atividade_datafim' =>$ativ->getDataFim(),
                ':atividade_professor' =>$ativ->getProfessor()
            ));

            if(!$res)
                throw new Exception("Atividade não foi criada:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Atividade: " . $ex->getMessage());
        }
    }

    public function get($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET);
            $stm->bindParam(':atividade_id', $id);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $ativ = new Atividade();
                $ativ->setId($result['atividade_id']);
                $ativ->setTipo($result['atividade_tipo']);
                $ativ->setDescricao($result['atividade_descricao']);
                $ativ->setDataInicio($result['atividade_datainicio']);
                $ativ->setDataFim($result['atividade_datafim']);
                $ativ->setProfessor($result['atividade_professor']);

                return $ativ;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar a Atividade por id:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getAll(){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET_ALL);
            $stm->execute();

            $ativ = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {

                $a = new Atividade();
                $a->setId($row['atividade_id']);
                $a->setTipo($row['atividade_tipo']);
                $a->setDescricao($row['atividade_descricao']);
                $a->setDataInicio($row['atividade_datainicio']);
                $a->setDataFim($row['atividade_datafim']);
                $a->setProfessor($row['atividade_professor']);

                $ativ[] = $a;
            }
            unset($a);

            if (empty($ativ))
                throw new NotFoundException();
            else
                return $ativ;

        } catch (PDOException $ex) {
            throw new Exception('Erro ao listar todos as Atividade:\t'
                . $ex->getMessage());
        }
    }

    public function update(Atividade $ativ){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);

            $stm->execute(array(
                ':atividade_id' =>$ativ->getId(),
                ':atividade_tipo' =>$ativ->getTipo(),
                ':atividade_descricao' =>$ativ->getDescricao(),
                ':atividade_datainicio' =>$ativ->getDataInicio(),
                ':atividade_datafim' =>$ativ->getDataFim(),
                ':atividade_professor' =>$ativ->getProfessor()
                ));

            if (!$stm->rowCount() > 0)
                throw new Exception("Atividade não foi atualizada:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao atualizar Atividade:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function delete($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
            $stm->bindParam(':atividade_id', $id);
            $stm->execute();

            if (!$stm->rowCount() > 0)
                throw new Exception("Atividade não foi deletada:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao deletar Atividade:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }
}

?>