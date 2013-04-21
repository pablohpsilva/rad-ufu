<?php
namespace RADUFU\DAO;

use RADUFU\Model\Atividade;

/**
 * Interface para CRUD basico
 */
interface IAtividadeDAO {

    /**
     * Insere o novo Atividade no BD
     * @param Atividade $Atividade O Atividade a ser inserido
     * @throws DAOException
     */
    public function post(Atividade $ativ,$idProfessor);

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
    public function update(Atividade $ativ,$idProfessor);

    /**
     * Removeo Atividade do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);

    /**
     * Busca uma atividade usando um Atividade e idProfessor
     * @param type Atividade $ativ, type $idProfessor
     * @throws DAOException
     */
    public function readAll(Atividade $ativ, $idProfessor);

    /**
     * Busca resultados e cria uma paginacao
     * @param type $idProfessor, type $linhaMinima, type $linhaMaxima, type $ordenacao
     * @throws DAOException
     */
    public function getPaginacao($idProfessor, $linhaMinima, $linhaMaxima, $ordenacao);
}

?>
