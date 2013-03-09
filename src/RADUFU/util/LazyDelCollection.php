<?php

namespace RADUFU\util;

/**
 * Wrapper para lazy deletion de coleções, os objetos que devem ser removidos
 * são mantidos em um array diferente dos que devem ser considerados evitando
 * multiplas chamads ao BD
 */
class LazyDelCollection {
    private $collection;

    function __construct() {
        $this->collection = array(
            'novos' => array(),
            'atuais' => array(),
            'toRemove' => array()
        );
    }
    /**
     * Adiciona um novo objeto a coleção, somente os objetos não existentes no
     * BD devem ser adicionados usando este método, os objetos já existentes
     * devem ser adicionados acessando o array atuais através do método atuais()
     * @param [type] $object Objeto a ser adicionado a coleção
     */
    public function add($object) {
        if(!array_key_exists($object->getId(), $this->collection['atuais']))
            $this->collection['novos'][$object->getId()] = $object;
    }
    /**
     * Remove um objeto da coleção
     * @param  [type] $id Id do objeto
     */
    public function remove($id) {
        if (array_key_exists($id, $this->collection['atuais'])) {

            $this->collection['toRemove'][$id] = $this->collection['atuais'][$id];
            unset($this->collection['atuais'][$id]);

        } else if (array_key_exists($id, $this->collection['novos'])){
            unset($this->collection['novos'][$id]);
        }
    }
    /**
     * @return array Os elementos atualmente existentes na coleção
     */
    public function atuais() {
        return $this->collection['atuais'];
    }
    /**
     * @return array Os elementos que devem ser removidos da coleção
     */
    public function toRemove() {
        return $this->collection['toRemove'];
    }
    /**
     * @return array Os elementos adicionados a coleção
     */
    public function novos() {
        return $this->collection['novos'];
    }

}

?>