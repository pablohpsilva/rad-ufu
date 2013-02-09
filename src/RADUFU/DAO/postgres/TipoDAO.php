<?php
namespace RADUFU\DAO\postgres;

use \PDO,
    RADUFU\Model\Tipo,
    RADUFU\DAO\Connection,
    RADUFU\DAO\ITipoDAO,
    RADUFU\DAO\Exception,
    RADUFU\DAO\NotFoundException;

/*
    require_once(__DIR__.'/../ITipoDAO.php');
    require_once(__DIR__.'/../Connection.php');
    require_once(__DIR__.'/../Exception.php');
    require_once(__DIR__.'/../NotFoundException.php');
*/
class TipoDAO implements ITipoDAO{

    const SQL_POST = 'INSERT INTO Tipo VALUES(
             DEFAULT,
            :tipo_categoria,
            :tipo_descricao,
            :tipo_pontuacao,
            :tipo_pontuacaoreferencia,
            :tipo_pontuacaolimite
            );';

    const SQL_UPDATE = 'UPDATE Tipo SET 
            tipo_categoria = :tipo_categoria,
            tipo_descricao = :tipo_descricao,
            tipo_pontuacao = :tipo_pontuacao,
            tipo_pontuacaoreferencia = :tipo_pontuacaoreferencia,
            tipo_pontuacaolimite = :tipo_pontuacaolimite
            WHERE tipo_id = :tipo_id;';

    const SQL_GET = 'SELECT * FROM Tipo WHERE tipo_id = :tipo_id;';
    const SQL_READ_ALL = 'SELECT * FROM Tipo;';
    const SQL_DELETE = 'DELETE FROM Tipo WHERE tipo_id = :tipo_id;';

    public function post(Tipo $tipo){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':tipo_categoria' =>$tipo->getCategoria(),
                ':tipo_descricao' =>$tipo->getDescricao(),
                ':tipo_pontuacao' =>$tipo->getPontuacao(),
                ':tipo_pontuacaoreferencia' =>$tipo->getPontuacaoReferencia(),
                ':tipo_pontuacaolimite' =>$tipo->getPontuacaoLimite()
            ));

            if(!$res)
                throw new Exception("Tipo não foi criado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Tipo: " . $ex->getMessage());
        }
    }

    public function get($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET);
            $stm->bindParam(':tipo_id', $id);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $tipo = new Tipo();
                $tipo->setId($result['tipo_id']);
                $tipo->setCategoria($result['tipo_categoria']);
                $tipo->setDescricao($result['tipo_descricao']);
                $tipo->setPontuacao($result['tipo_pontuacao']);
                $tipo->setPontuacaoReferencia($result['tipo_pontuacaoreferencia']);
                $tipo->setPontuacaoLimite($result['tipo_pontuacaolimite']);

                return $tipo;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Tipo por codigo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getAll(){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ_ALL);
            $stm->execute();

            $tipo = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                $t = new Tipo();
                $t->setId($row['tipo_id']);
                $t->setCategoria($row['tipo_categoria']);
                $t->setDescricao($row['tipo_descricao']);
                $t->setPontuacao($row['tipo_pontuacao']);
                $t->setPontuacaoReferencia($row['tipo_pontuacaoreferencia']);
                $t->setPontuacaoLimite($row['tipo_pontuacaolimite']);

                $tipo[] = $t;
            }
            unset($t);

            if (empty($tipo))
                throw new NotFoundException();
            else
                return $tipo;

        } catch (PDOException $ex) {
            throw new Exception('Erro ao listar todos os Tipos:\t'
                . $ex->getMessage());
        }
    }

    public function update(Tipo $tipo){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);

            $stm->execute(array(
                ':tipo_id' =>$tipo->getId(),
                ':tipo_categoria' =>$tipo->getCategoria(),
                ':tipo_descricao' =>$tipo->getDescricao(),
                ':tipo_pontuacao' =>$tipo->getPontuacao(),
                ':tipo_pontuacaoreferencia' =>$tipo->getPontuacaoReferencia(),
                ':tipo_pontuacaolimite' =>$tipo->getPontuacaoLimite()
                ));

            if (!$stm->rowCount() > 0)
                throw new Exception("Tipo não foi atualizado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao atualizar Tipo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function delete($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
            $stm->bindParam(':tipo_id', $id);
            $stm->execute();

            if (!$stm->rowCount() > 0)
                throw new Exception("Tipo não foi deletado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao deletar Tipo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }
}
?>