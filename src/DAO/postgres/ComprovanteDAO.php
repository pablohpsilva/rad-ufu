<?php
/*
namespace DAO;

use \PDO,
    model\Comprovante,
    DAO\Connection,
    DAO\IComprovanteDAO,
    DAO\Exception,
    DAO\NotFoundException;
*/

    require_once(__DIR__ . '/../IComprovanteDAO.php');
    require_once(__DIR__.'/../Connection.php');
    require_once(__DIR__.'/../Exception.php');
    require_once(__DIR__.'/../NotFoundException.php');

class ComprovanteDAO implements IComprovanteDAO{
	const SQL_POST = 'INSERT INTO Comprovante VALUES(DEFAULT,:comprovante_arquivo,:comprovante_atividade);';
	const SQL_UPDATE = 'UPDATE Comprovante SET
        comprovante_arquivo = :comprovante_arquivo,
        comprovante_atividade = :comprovante_atividade
		WHERE comprovante_id = :comprovante_id;';
	const SQL_GET = 'SELECT * FROM Comprovante WHERE comprovante_id = :comprovante_id;';
    const SQL_READ = 'SELECT * FROM Comprovante WHERE comprovante_arquivo = :comprovante_arquivo;';
	const SQL_READ_ALL = 'SELECT * FROM Comprovante;';
	const SQL_DELETE = 'DELETE FROM Comprovante WHERE comprovante_id = :comprovante_id;';

	public function post(Comprovante $comp){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':comprovante_arquivo' => $comp->getArquivo(),
                ':comprovante_atividade' => $comp->getAtividade()
            ));

            if(!$res)
                throw new Exception("Comprovante não foi criado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Comprovante: " . $ex->getMessage());
        }
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
                $comp->setAtividade($result['comprovante_atividade']);

                return $comp;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Comprovante por arquivo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function read($arquivo){
    	try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->bindParam(':comprovante_arquivo', $arquivo);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $comp = new Comprovante();
                $comp->setId($result['comprovante_id']);
                $comp->setArquivo($result['comprovante_arquivo']);
                $comp->setAtividade($result['comprovante_atividade']);

                return $comp;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Comprovante por arquivo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getAll(){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ_ALL);
            $stm->execute();

            $comp = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {

                $c = new Comprovante();
                $c->setId($result['comprovante_id']);
                $c->setArquivo($row['comprovante_arquivo']);
                $c->setAtividade($row['comprovante_atividade']);

                $comp[] = $c;
            }
            unset($c);

            if (empty($comp))
                throw new NotFoundException();
            else
                return $comp;

        } catch (PDOException $ex) {
            throw new Exception('Erro ao listar todos os Comprovantes:\t'
                . $ex->getMessage());
        }
    }

    public function update(Comprovante $comp){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);

            $stm->execute(array(
                ':comprovante_id' => $comp->getId(),
                ':comprovante_arquivo' => $comp->getArquivo(),
                ':comprovante_atividade' => $comp->getAtividade()
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

}

?>