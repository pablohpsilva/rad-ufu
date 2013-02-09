<?php

namespace RADUFU\DAO\postgres;

use \PDO,
    RADUFU\model\Professor,
    RADUFU\DAO\Connection,
    RADUFU\DAO\IProfessorDAO,
    RADUFU\DAO\Exception,
    RADUFU\DAO\NotFoundException;


//use  model\Professor;
    require_once(__DIR__.'/../../model/Professor.php');
    require_once(__DIR__.'/../IProfessorDAO.php');
    require_once(__DIR__.'/../Connection.php');
    require_once(__DIR__.'/../Exception.php');
    require_once(__DIR__.'/../NotFoundException.php');

class ProfessorDAO implements IProfessorDAO{

    const SQL_POST = 'INSERT INTO Professor VALUES(
            :professor_id,
             DEFAULT,
            :professor_nome,
            :professor_sobrenome,
            :professor_usuario,
            :professor_senha
            );';

    const SQL_UPDATE = 'UPDATE Professor SET 
            professor_ativo =:professor_ativo, 
            professor_nome = :professor_nome, 
            professor_sobrenome = :professor_sobrenome, 
            professor_senha = :professor_senha 
            WHERE professor_id = :professor_id;';

    const SQL_GET = 'SELECT * FROM Professor WHERE professor_id = :professor_id;';
    const SQL_READ = 'SELECT * FROM Professor WHERE professor_usuario = :professor_usuario;';
    const SQL_READ_ALL = 'SELECT * FROM Professor;';
    const SQL_DELETE = 'DELETE FROM Professor WHERE professor_id = :professor_id;';

    public function post(Professor $prof){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':professor_id' =>$prof->getId(),
                ':professor_nome' =>$prof->getNome(),
                ':professor_sobrenome' =>$prof->getSobrenome(),
                ':professor_usuario' =>$prof->getUsuario(),
                ':professor_senha' =>$prof->getSenha()
            ));

            if(!$res)
                throw new Exception("Professor não foi criado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Professor: " . $ex->getMessage());
        }
    }

    public function get($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET);
            $stm->bindParam(':professor_id', $id);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $prof = new Professor();
                $prof->setId($result['professor_id']);
                $prof->setAtivo($result['professor_ativo']);
                $prof->setNome($result['professor_nome']);
                $prof->setSobrenome($result['professor_sobrenome']);
                $prof->setUsuario($result['professor_usuario']);
                $prof->setSenha($result['professor_senha']);

                return $prof;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Professor por id:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function read($usuario){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->bindParam(':professor_usuario', $usuario);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $prof = new Professor();
                $prof->setId($result['professor_id']);
                $prof->setAtivo($result['professor_ativo']);
                $prof->setNome($result['professor_nome']);
                $prof->setSobrenome($result['professor_sobrenome']);
                $prof->setUsuario($result['professor_usuario']);
                $prof->setSenha($result['professor_senha']);

                return $prof;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar Professor por usuario:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getAll(){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ_ALL);
            $stm->execute();

            $prof = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                $p = new Professor();
                $p->setId($row['professor_id']);
                $p->setAtivo($row['professor_ativo']);
                $p->setNome($row['professor_nome']);
                $p->setSobrenome($row['professor_sobrenome']);
                $p->setUsuario($row['professor_usuario']);
                $p->setSenha($row['professor_senha']);

                $prof[] = $p;
            }

            if (empty($prof))
                throw new NotFoundException();
            else
                return $prof;

        } catch (PDOException $ex) {
            throw new Exception('Erro ao listar todos os professores:\t'
                . $ex->getMessage());
        }
    }

    public function update(Professor $prof){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);

            $stm->execute(array(
                ':professor_id' =>$prof->getId(),
                ':professor_ativo' =>$prof->getAtivo(),
                ':professor_nome' =>$prof->getNome(),
                ':professor_sobrenome' =>$prof->getSobrenome(),
                ':professor_senha' =>$prof->getSenha()
                ));

            if (!$stm->rowCount() > 0)
                throw new Exception("Professor não foi atualizado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao atualizar Professor:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function delete($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
            $stm->bindParam(':professor_id', $id);
            $stm->execute();

            if (!$stm->rowCount() > 0)
                throw new Exception("Professor não foi deletado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao deletar Professor:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }
    
}

?>
