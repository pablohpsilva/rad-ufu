<?php
namespace RADUFU\DAO;

use RADUFU\Model\Tipo;

/**
 * Interface para CRUD basico
 */
interface ITipoDAO {

    /**
     * Insere o novo Tipo no BD
     * @param Tipo $tipo O tipo a ser inserido
     * @throws DAOException
     */
    public function post(Tipo $tipo);

    /**
     * Recupera o Tipo a partir do id
     * @param type $id
     * @return tipo O tipo encontrado
     * @throws DAOException
     */
    public function get($id);

    /**
     * Recupera o Tipo a partir do id
     * @param type $id
     * @return tipo O tipo encontrado
     * @throws DAOException
     */
    public function read($idCategoria);

    /**
     * Recupera todas os Tipos
     * @return array tipoes encontradas
     * @throws DAOException
     */
    public function getAll();

    /**
     * Atualiza os atributos do Tipo no BD
     * @param tipo $tipo
     * @throws DAOException
     */
    public function update(Tipo $tipo);

    /**
     * Remove o Tipo do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);

    /**
     * Busca um tipo usando um Tipo
     * @param type Tipo $tipo
     * @throws DAOException
     */
    public function readAll(Tipo $tipo);
}

?>
