<?php

namespace DAO;

use model\Tipo;

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
     * Removeo tipo do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);
}

?>
