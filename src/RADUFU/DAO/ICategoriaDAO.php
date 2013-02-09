<?php
namespace RADUFU\DAO;

use RADUFU\Model\Categoria;

/**
 * Interface para CRUD basico
 */
interface ICategoriaDAO {

    /**
     * Insere o novo categoria no BD
     * @param categoria $categoria A categoria a ser inserida
     * @throws DAOException
     */
    public function post(Categoria $cat);

    /**
     * Recupera o categoria a partir do id
     * @param type $name
     * @return categoria A categoria encontrada
     * @throws DAOException
     */
    public function get($name);

    /**
     * Recupera o categoria a partir do nome
     * @param type $name
     * @return categoria A categoria encontrada
     * @throws DAOException
     */
    public function read($name);

    /**
     * Recupera todas as categorias
     * @return array categorias encontradas
     * @throws DAOException
     */
    public function getAll();

    /**
     * Atualiza os atributos do categoria no BD
     * @param categoria $cat
     * @throws DAOException
     */
    //public function update(Categoria $cat);

    /**
     * Removeo categoria do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);
}

?>
