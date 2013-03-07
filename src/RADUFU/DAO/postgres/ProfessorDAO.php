<?php
namespace RADUFU\DAO\postgres;

use \PDO,
    RADUFU\Model\Professor,
    RADUFU\DAO\Connection,
    RADUFU\DAO\IProfessorDAO,
    RADUFU\DAO\Exception,
    RADUFU\DAO\NotFoundException;

class ProfessorDAO implements IProfessorDAO{

    const SQL_POST = 'INSERT INTO Professor VALUES(
            DEFAULT,
            :professor_nome,
            :professor_siape,
            :professor_senha
            );';

    const SQL_UPDATE = 'UPDATE Professor SET 
            professor_nome = :professor_nome, 
            professor_senha = :professor_senha 
            WHERE professor_id = :professor_id;';

    const SQL_GET = 'SELECT * FROM Professor WHERE professor_id = :professor_id;';
    const SQL_READ = 'SELECT * FROM Professor WHERE professor_siape = :professor_siape;';
    const SQL_READ_ALL = 'SELECT * FROM Professor;';
    const SQL_DELETE = 'DELETE FROM Professor WHERE professor_id = :professor_id;';

    private $atividadeDAO;

    public function post(Professor $prof){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);

            $res = $stm->execute(array(
                ':professor_nome' =>$prof->getNome(),
                ':professor_siape' =>$prof->getSiape(),
                ':professor_senha' =>$prof->getSenha()
            ));

            if(!$res)
                throw new Exception("Professor não foi criado:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Professor: " . $ex->getMessage());
        }
    }

    private function getAllTemplate($stm){
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $prof = new Professor();
            $prof->setId($result['professor_id']);
            $prof->setNome($result['professor_nome']);
            $prof->setSiape($result['professor_siape']);
            $prof->setSenha($result['professor_senha']);

            $atividadeDAO = new AtividadeDAO();
            foreach ($atividadeDAO->read($prof->getId()) as $val) {
                $prof->addAtividade($val);
            }

            unset($atividadeDAO,$val);

            return $prof;
        }

        throw new NotFoundException();
    }

    public function get($id){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_GET);
            $stm->bindParam(':professor_id', $id);
            
            return $this->getAllTemplate($stm);

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar o Professor por id:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function read($siape){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->bindParam(':professor_siape', $siape);
            
            return $this->getAllTemplate($stm);

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar Professor por siape:\t"
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
                $p->setNome($row['professor_nome']);
                $p->setSiape($row['professor_siape']);
                $p->setSenha($row['professor_senha']);

                $atividadeDAO = new AtividadeDAO();
                foreach ($atividadeDAO->read($p->getId()) as $val) {
                    $p->addAtividade($val);
                }

                $prof[] = $p;
            }

            unset($atividadeDAO,$val,$p);

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
                ':professor_nome' =>$prof->getNome(),
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
