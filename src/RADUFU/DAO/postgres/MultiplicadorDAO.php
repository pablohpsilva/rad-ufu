<?php
namespace RADUFU\DAO\postgres;

use \PDO,
    RADUFU\Model\Multiplicador,
    RADUFU\DAO\Connection,
    RADUFU\DAO\IMultiplicadorDAO,
    RADUFU\DAO\Exception,
    RADUFU\DAO\NotFoundException;

class MultiplicadorDAO implements IMultiplicadorDAO{

    const SQL_POST = 'INSERT INTO Multiplicador VALUES(
             DEFAULT,
            :multiplicador_nome,
            /*:multiplicador_valor,*/
            :multiplicador_limite,
            :multiplicador_tipo_atividade
            );';

    const SQL_UPDATE = 'UPDATE Multiplicador SET 
            multiplicador_nome =:multiplicador_nome, 
            /*multiplicador_valor = :multiplicador_valor, */
            multiplicador_limite = :multiplicador_limite, 
            multiplicador_tipo_atividade = :multiplicador_tipo_atividade 
            WHERE multiplicador_id = :multiplicador_id;';

    const SQL_GET = 'SELECT * FROM Multiplicador WHERE multiplicador_id = :multiplicador_id;';
    const SQL_READ = 'SELECT * FROM Multiplicador WHERE multiplicador_nome = :multiplicador_nome;';
    const SQL_READ_ALL = 'SELECT * FROM Multiplicador;';
    const SQL_DELETE = 'DELETE FROM Multiplicador WHERE multiplicador_id = :multiplicador_id;';

    public function post(Multiplicador $mult){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':multiplicador_nome' => $mult->getNome(),
                /*':multiplicador_valor' => $mult->getValor(),*/
                ':multiplicador_limite' => $mult->getLimite(),
                ':multiplicador_tipo_atividade' => $mult->getTipoAtividade()
            ));

            if(!$res)
                throw new Exception("Multiplicador não foi criado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Multiplicador: " . $ex->getMessage());
        }
    }

    public function get($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET);
            $stm->bindParam(':multiplicador_id', $id);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $mult = new Multiplicador();
                $mult->setId($result['multiplicador_id']);
                $mult->setNome($result['multiplicador_nome']);
                /*$mult->setValor($result['multiplicador_valor']);*/
                $mult->setlimite($result['multiplicador_limite']);
                $mult->setTipoAtividade($result['multiplicador_tipo_atividade']);

                return $mult;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Multiplicador por id:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function read($nome){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->bindParam(':multiplicador_nome', $nome);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $mult = new Multiplicador();
                $mult->setId($result['multiplicador_id']);
                $mult->setNome($result['multiplicador_nome']);
                /*$mult->setValor($result['multiplicador_valor']);*/
                $mult->setlimite($result['multiplicador_limite']);
                $mult->setTipoAtividade($result['multiplicador_tipo_atividade']);

                return $mult;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar Multiplicador por nome:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getAll(){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ_ALL);
            $stm->execute();

            $mult = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                $m = new Multiplicador();
                $m->setId($row['multiplicador_id']);
                $m->setNome($row['multiplicador_nome']);
                /*$m->setValor($row['multiplicador_valor']);*/
                $m->setlimite($row['multiplicador_limite']);
                $m->setTipoAtividade($row['multiplicador_tipo_atividade']);

                $mult[] = $m;
            }
            unset($m);

            if (empty($mult))
                throw new NotFoundException();
            else
                return $mult;

        } catch (PDOException $ex) {
            throw new Exception('Erro ao listar todos os Multiplicadores:\t'
                . $ex->getMessage());
        }
    }

    public function update(Multiplicador $mult){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);

            $stm->execute(array(
                ':multiplicador_id' => $mult->getId(),
                ':multiplicador_nome' => $mult->getNome(),
                /*':multiplicador_valor' => $mult->getValor(),*/
                ':multiplicador_limite' => $mult->getLimite(),
                ':multiplicador_tipo_atividade' => $mult->getTipoAtividade()
                ));

            if (!$stm->rowCount() > 0)
                throw new Exception("Multiplicador não foi atualizado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao atualizar Multiplicador:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function delete($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
            $stm->bindParam(':multiplicador_id', $id);
            $stm->execute();

            if (!$stm->rowCount() > 0)
                throw new Exception("Multiplicador não foi deletado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao deletar Multiplicador:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }
}

?>
