<?php
namespace RADUFU\DAO\postgres;

use \PDO,
    RADUFU\Model\Comprovante,
    RADUFU\DAO\Connection,
    RADUFU\DAO\IComprovanteDAO,
    RADUFU\DAO\Exception,
    RADUFU\DAO\NotFoundException;

class ComprovanteDAO implements IComprovanteDAO{
	const SQL_POST = 'INSERT INTO Comprovante VALUES(DEFAULT,:comprovante_arquivo,:comprovante_atividade);';
	const SQL_UPDATE = 'UPDATE Comprovante SET
        comprovante_arquivo = :comprovante_arquivo,
        comprovante_atividade = :comprovante_atividade
		WHERE comprovante_id = :comprovante_id;';
	const SQL_GET = 'SELECT * FROM Comprovante WHERE comprovante_id = :comprovante_id;';
    const SQL_GET_ALL = 'SELECT * FROM Comprovante;';
    const SQL_READ = 'SELECT * FROM Comprovante WHERE comprovante_atividade = :comprovante_atividade;';
	const SQL_DELETE = 'DELETE FROM Comprovante WHERE comprovante_id = :comprovante_id;';
    const SQL_READALL = 'SELECT comprovante_id FROM Comprovante WHERE
        comprovante_arquivo = :comprovante_arquivo AND
        comprovante_atividade = :comprovante_atividade;';

	public function post(Comprovante $comp, $idAtividade){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':comprovante_arquivo' => $comp->getArquivo(),
                ':comprovante_atividade' => $idAtividade
            ));

            if(!$res)
                throw new Exception("Comprovante não foi criado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Comprovante: " . $ex->getMessage());
        }
    }

    public function getAllTemplate($stm){
        $stm->execute();

        $comp = array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $c = new Comprovante();
            $c->setId($row['comprovante_id']);
            $c->setArquivo($row['comprovante_arquivo']);

            $comp[] = $c;
        }
        unset($c);
        return $comp;
    }

    public function get($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET);
            $stm->bindParam(':comprovante_id', $id);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $comp = new Comprovante();
                $comp->setId($result['comprovante_id']);
                $comp->setArquivo($result['comprovante_arquivo']);

                return $comp;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Comprovante por arquivo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function read($idAtividade){
    	try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->bindParam(':comprovante_atividade', $idAtividade);

            return $this->getAllTemplate($stm);

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Comprovante por arquivo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getAll(){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET_ALL);
            
            return $this->getAllTemplate($stm);

        } catch (PDOException $ex) {
            throw new Exception('Erro ao listar todos os Comprovantes:\t'
                . $ex->getMessage());
        }
    }
    
    public function update(Comprovante $comp, $idAtividade){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);

            $stm->execute(array(
                ':comprovante_id' => $comp->getId(),
                ':comprovante_arquivo' => $comp->getArquivo(),
                ':comprovante_atividade' => $idAtividade
                ));

            if (!$stm->rowCount() > 0)
                throw new Exception("Comprovante não foi atualizado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao atualizar Comprovante:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function delete($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
            $stm->bindParam(':comprovante_id', $id);
            $stm->execute();

            if (!$stm->rowCount() > 0)
                throw new Exception("Comprovante não foi deletado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao deletar Comprovante:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function readAll(Comprovante $comp, $idAtividade){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READALL);

            $stm->execute(array(
                ':comprovante_arquivo' => $comp->getArquivo(),
                ':comprovante_atividade' => $idAtividade
                ));

            $result = $stm->fetch(PDO::FETCH_ASSOC);
            
            return $result['comprovante_id'];

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar id por Comprovante:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

}

?>