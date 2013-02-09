<?php
namespace RADUFU\DAO;

use RADUFU\Model\Multiplicador;
/**
 * Interface para CRUD basico
 */
interface IMultiplicadorDAO {

    /**
     * Insere o novo Multiplicador no BD
     * @param Multiplicador $multiplicador O Multiplicador a ser inserido
     * @throws DAOException
     */
    public function post(Multiplicador $multiplicador);

    /**
     * Recupera o Multiplicador a partir do id
     * @param type $id
     * @return Multiplicador O Multiplicador encontrado
     * @throws DAOException
     */
    public function get($id);

    /**
     * Recupera o Multiplicador a partir do nome
     * @param type $nome
     * @return Multiplicador O Multiplicador encontrado
     * @throws DAOException
     */
    public function read($nome);

    /**
     * Recupera todas os Multiplicadores
     * @return array Multiplicadores encontrados
     * @throws DAOException
     */
    public function getAll();

    /**
     * Atualiza os atributos do Multiplicador no BD
     * @param Multiplicador $multiplicador
     * @throws DAOException
     */
    public function update(Multiplicador $multiplicador);

    /**
     * Remove o Multiplicador do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);
}

?>
