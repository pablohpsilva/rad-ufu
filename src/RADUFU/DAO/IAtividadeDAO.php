<?php
namespace RADUFU\DAO;

use RADUFU\Model\Atividade;

//require_once(__DIR__ . '/../model/Atividade.php');
/**
 * Interface para CRUD basico
 */
interface IAtividadeDAO {

    /**
     * Insere o novo Atividade no BD
     * @param Atividade $Atividade O Atividade a ser inserido
     * @throws DAOException
     */
    public function post(Atividade $ativ);

    /**
     * Recupera o Atividade a partir do id
     * @param type $id
     * @return Atividade O Atividade encontrado
     * @throws DAOException
     */
    public function get($id);

    /**
     * Recupera o Atividade a partir do id
     * @param type $id
     * @return Atividade O Atividade encontrado
     * @throws DAOException
     */
    public function read($idProfessor);

    /**
     * Recupera todas as Atividadees
     * @return array Atividadees encontradas
     * @throws DAOException
     */
    public function getAll();

    /**
     * Atualiza os atributos do Atividade no BD
     * @param Atividade $ativ
     * @throws DAOException
     */
    public function update(Atividade $ativ);

    /**
     * Removeo Atividade do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);
}

?>
