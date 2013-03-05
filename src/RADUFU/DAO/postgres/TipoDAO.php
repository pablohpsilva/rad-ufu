<?php
namespace RADUFU\DAO\postgres;

use \PDO,
    RADUFU\Model\Tipo,
    RADUFU\DAO\Connection,
    RADUFU\DAO\ITipoDAO,
    RADUFU\DAO\Exception,
    RADUFU\DAO\NotFoundException;

class TipoDAO implements ITipoDAO{

    const SQL_POST = 'INSERT INTO Tipo VALUES(
            DEFAULT,
            :tipo_categoria,
            :tipo_descricao,
            :tipo_pontuacao,
            :tipo_pontuacaoreferencia,
            :tipo_pontuacaolimite,
            :tipo_multiplicador
            );';

    const SQL_UPDATE = 'UPDATE Tipo SET 
            tipo_categoria = :tipo_categoria,
            tipo_descricao = :tipo_descricao,
            tipo_pontuacao = :tipo_pontuacao,
            tipo_pontuacaoreferencia = :tipo_pontuacaoreferencia,
            tipo_pontuacaolimite = :tipo_pontuacaolimite,
            tipo_multiplicador = :tipo_multiplicador
            WHERE tipo_id = :tipo_id;';

    const SQL_GET = 'SELECT * FROM Tipo WHERE tipo_id = :tipo_id;';
    const SQL_READ = 'SELECT * FROM Tipo WHERE tipo_categoria = :tipo_categoria;';
    const SQL_GET_NEXT_ID = "SELECT NEXTVAL('tipo_tipo_id_seq');";
    const SQL_RESET_NEXT_ID = "SELECT SETVAL('tipo_tipo_id_seq', :next_id);";
    const SQL_READ_ALL = 'SELECT * FROM Tipo;';
    const SQL_DELETE = 'DELETE FROM Tipo WHERE tipo_id = :tipo_id;';

    private $multiplicadorDAO;
    private $categoriaDAO;

    public function post(Tipo $tipo){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':tipo_categoria' => $tipo->getCategoria()->getId(),
                ':tipo_descricao' => $tipo->getDescricao(),
                ':tipo_pontuacao' => $tipo->getPontuacao(),
                ':tipo_pontuacaoreferencia' => $tipo->getPontuacaoReferencia(),
                ':tipo_pontuacaolimite' => $tipo->getPontuacaoLimite(),
                ':tipo_multiplicador' => $tipo->getMultiplicador()->getId()
                ));

            if(!$res)
                throw new Exception("Tipo não foi criado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Tipo: " . $ex->getMessage());
        }
    }

    private function getAllTemplate($stm){
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $tipo = new Tipo();
            $tipo->setId($result['tipo_id']);
            $tipo->setDescricao($result['tipo_descricao']);
            $tipo->setPontuacao($result['tipo_pontuacao']);
            $tipo->setPontuacaoReferencia($result['tipo_pontuacaoreferencia']);
            $tipo->setPontuacaoLimite($result['tipo_pontuacaolimite']);

            $this->categoriaDAO = new CategoriaDAO();
            $tipo->setCategoria($this->categoriaDAO->get($result['tipo_categoria']));

            $this->multiplicadorDAO = new MultiplicadorDAO();
            $tipo->setMultiplicador($this->multiplicadorDAO->get($result['tipo_multiplicador']));

            unset($this->multiplicadorDAO,$this->categoriaDAO);
            return $tipo;
        }

        throw new NotFoundException();
    }

    public function get($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET);
            $stm->bindParam(':tipo_id', $id);

            return $this->getAllTemplate($stm);
            

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Tipo por codigo:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function read($idCategoria){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->bindParam(':tipo_categoria', $idCategoria);

            return $this->getAllTemplate($stm);
            

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
                $t->setDescricao($row['tipo_descricao']);
                $t->setPontuacao($row['tipo_pontuacao']);
                $t->setPontuacaoReferencia($row['tipo_pontuacaoreferencia']);
                $t->setPontuacaoLimite($row['tipo_pontuacaolimite']);

                $this->categoriaDAO = new CategoriaDAO();
                $t->setCategoria($this->categoriaDAO->get($row['tipo_categoria']));
                
                $this->multiplicadorDAO = new MultiplicadorDAO();
                $t->setMultiplicador($this->multiplicadorDAO->get($row['tipo_multiplicador']));

                $tipo[] = $t;
            }
            unset($t,$this->multiplicadorDAO,$this->categoriaDAO);

            if (empty($tipo))
                throw new NotFoundException();
            else
                return $tipo;

        } catch (PDOException $ex) {
            throw new Exception('Erro ao listar todos os Tipos:\t'
                . $ex->getMessage());
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

    public function update(Tipo $tipo){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);

            $stm->execute(array(
                ':tipo_id' =>$tipo->getId(),
                ':tipo_categoria' =>$tipo->getCategoria()->getId(),
                ':tipo_descricao' =>$tipo->getDescricao(),
                ':tipo_pontuacao' =>$tipo->getPontuacao(),
                ':tipo_pontuacaoreferencia' =>$tipo->getPontuacaoReferencia(),
                ':tipo_pontuacaolimite' =>$tipo->getPontuacaoLimite(),
                ':tipo_multiplicador' => $tipo->getMultiplicador()->getId()
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
