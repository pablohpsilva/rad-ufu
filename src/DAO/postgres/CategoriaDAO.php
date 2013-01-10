<?php
/*
namespace DAO;

use \PDO,
    model\Categoria,
    DAO\Connection,
    DAO\ICategoriaDAO,
    DAO\Exception,
    DAO\NotFoundException;
*/
    require_once(__DIR__ . '/../ICategoriaDAO.php');
    require_once(__DIR__.'/../Connection.php');
    require_once(__DIR__.'/../Exception.php');
    require_once(__DIR__.'/../NotFoundException.php');

class CategoriaDAO implements ICategoriaDAO{

    const SQL_POST = 'INSERT INTO Categoria VALUES(:categoria_nome);';
    const SQL_UPDATE = 'UPDATE Categoria SET categoria_nome = :categoria_nome WHERE categoria_nome = :categoria_nome;';
    const SQL_READ = 'SELECT * FROM Categoria WHERE categoria_nome = :categoria_nome;';
    const SQL_READ_ALL = 'SELECT * FROM Categoria;';
    const SQL_DELETE = 'DELETE FROM Categoria WHERE categoria_nome = :categoria_nome;';

    public function post(Categoria $cat){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $res = $stm->execute(array(
                    ':categoria_nome' => $cat->getNome()
                ));

            if(!$res)
                throw new Exception("Categoria não foi criada:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Categoria: " . $ex->getMessage());
        }
    }

    public function read($nome){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ);
            $stm->bindParam(':categoria_nome', $nome);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $cat = new Categoria();
                $cat->setNome($result['categoria_nome']);
                return $cat;
            }

            throw new NotFoundException();

        } catch (PDOException $ex) {
            throw new Exception("Ao procurar Categoria por nome:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }

    public function getAll(){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_READ_ALL);
            $stm->execute();

            $cat = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {

                $c = new Categoria();
                $c->setNome($row['categoria_nome']);

                $cat[] = $c;
            }

            if (empty($cat))
                throw new NotFoundException();
            else
                return $cat;

        } catch (PDOException $ex) {
            throw new Exception("Erro ao listar todas as categorias:\t"
                . $ex->getMessage());
        }
    }
/*
    public function update(Categoria $cat){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);
            $stm->bindParam(':categoria_nome', $nome);
            $stm->execute();

            if (!$stm->rowCount() > 0)
                throw new Exception("Categoria não foi atualizada:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao atualizar Categoria:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }
*/
    public function delete($nome){
        try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
            $stm->bindParam(':categoria_nome', $nome);
            $stm->execute();

            if (!$stm->rowCount() > 0)
                throw new Exception("Categoria não foi deletada:\t"
                    . $stm->errorInfo()[2]);

        } catch (PDOException $ex) {
            throw new Exception("Ao deletar Categoria:\t"
                . $ex->getMessage(), 0, $ex);
        }
    }
}

?>
