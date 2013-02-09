<?php
namespace RADUFU\DAO;

use RADUFU\Model\Professor;

/**
 * Interface para CRUD basico
 */
interface IProfessorDAO {

    /**
     * Insere o novo professor no BD
     * @param Professor $professor O professor a ser inserido
     * @throws DAOException
     */
    public function post(Professor $prof);

    /**
     * Recupera o professor a partir do id
     * @param type $id
     * @return Professor O professor encontrado
     * @throws DAOException
     */
    public function get($id);

    /**
     * Recupera o professor a partir do nome
     * @param type $name
     * @return Professor O professor encontrado
     * @throws DAOException
     */
    public function read($name);

    /**
     * Recupera todas as professores
     * @return array professores encontradas
     * @throws DAOException
     */
    public function getAll();

    /**
     * Atualiza os atributos do professor no BD
     * @param Professor $prof
     * @throws DAOException
     */
    public function update(Professor $prof);

    /**
     * Removeo professor do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);
}

?>
