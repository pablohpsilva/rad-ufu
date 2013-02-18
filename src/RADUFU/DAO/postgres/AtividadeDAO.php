<?php
namespace RADUFU\DAO\postgres;

use \PDO,
    RADUFU\Model\Atividade,
    RADUFU\DAO\Connection,
    RADUFU\DAO\IAtividadeDAO,
    RADUFU\DAO\Exception,
    RADUFU\DAO\NotFoundException;
    
class AtividadeDAO implements IAtividadeDAO{
	const SQL_POST = 'INSERT INTO Atividade VALUES(
		DEFAULT,
		:atividade_tipo,
		:atividade_descricao, 
		:atividade_datainicio,
		:atividade_datafim,
        /*modificado o campo abaixo*/
        :atividade_multiplicador_valor,
		:atividade_professor
		);';
	const SQL_UPDATE = 'UPDATE Atividade SET 
		atividade_tipo = :atividade_tipo,
		atividade_descricao = :atividade_descricao, 
		atividade_datainicio = :atividade_datainicio,
		atividade_datafim = :atividade_datafim,
        /*modificado o campo abaixo*/
        atividade_multiplicador_valor = :atividade_multiplicador_valor,
		atividade_professor = :atividade_professor
		WHERE atividade_id = :atividade_id;';
	const SQL_GET = 'SELECT * FROM Atividade WHERE atividade_id = :atividade_id;';
    const SQL_GET_NEXT_ID = "SELECT NEXTVAL('atividade_atividade_id_seq');";
    const SQL_RESET_NEXT_ID = "SELECT SETVAL('atividade_atividade_id_seq', :next_id);";
    const SQL_READ = 'SELECT * FROM Atividade WHERE atividade_professor = :atividade_professor;';
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
                /*modificado o campo abaixo*/
                ':atividade_multiplicador_valor' =>$ativ->getValor(),
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
                /*modificado o campo abaixo*/
                $ativ->setValor($result['atividade_multiplicador_valor']);
                $ativ->setProfessor($result['atividade_professor']);

                return $ativ;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar a Atividade por id:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getNextId(){
        try{
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET_NEXT_ID);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            $next = $result['nextval'];

            $stm = Connection::Instance()->get()->prepare(self::SQL_RESET_NEXT_ID);
            $aux = $next-1;
            $stm->bindParam(':next_id', $aux);
            $stm->execute();
            unset($aux,$result,$stm);
            return $next;
        } catch (PDOException $ex) {
            throw new Exception("Ao procurar a Atividade por id:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function read($idProfessor){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->execute(array(':atividade_professor'=>$idProfessor));

            $ativ = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                $a = new Atividade();
                $a->setId($row['atividade_id']);
                $a->setTipo($row['atividade_tipo']);
                $a->setDescricao($row['atividade_descricao']);
                $a->setDataInicio($row['atividade_datainicio']);
                $a->setDataFim($row['atividade_datafim']);
                /*modificado o campo abaixo*/
                $a->setValor($result['atividade_multiplicador_valor']);
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
                /*modificado o campo abaixo*/
                $a->setValor($result['atividade_multiplicador_valor']);
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
                /*modificado o campo abaixo*/
                ':atividade_multiplicador_valor' =>$ativ->getValor(),
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