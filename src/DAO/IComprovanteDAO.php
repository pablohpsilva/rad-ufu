<?php

namespace DAO;

use model\Comprovante;

/**
 * Interface para CRUD basico
 */
interface IComprovanteDAO {

    /**
     * Insere o novo comprovante no BD
     * @param Comprovante $Comprovante O comprovante a ser inserido
     * @throws DAOException
     */
    public function post(Comprovante $comp);

    /**
     * Recupera o comprovante a partir do arquivo
     * @param type $arquivo
     * @return Comprovante O comprovante encontrado
     * @throws DAOException
     */
    public function read($arquivo);

    /**
     * Recupera todas as comprovantees
     * @return array comprovantes encontradas
     * @throws DAOException
     */
    public function getAll();

    /**
     * Atualiza os atributos do comprovante no BD
     * @param Comprovante $prof
     * @throws DAOException
     */
    public function update(Comprovante $comp);

    /**
     * Remove o comprovante do BD
     * @param type $arquivo
     * @throws DAOException
     */
    public function delete($arquivo);
}

?>
