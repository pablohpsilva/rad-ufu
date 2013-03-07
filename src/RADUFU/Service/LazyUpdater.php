<?php
namespace RADUFU\Service;

class LazyUpdater{

	// FALTA REMOVER TUDO E ADICIONAR TUDO
	
	public static function lazyUpdaterJob($oldCollection,$newCollection,$service){
		if(!empty($oldCollection) && !is_null($newCollection) || !empty($newCollection)){
			$toRemove = array();
			$toAdd = array();

			foreach ($oldCollection as $val) {
				// Se o objeto antigo existir na colecao antiga, coloca no toAdd
				if(in_array($val, $newCollection))
					$toAdd[] = $val;
				// Caso contrario, coloco para ser removido
				else
					$toRemove[] = $val;
			}

			//Agora preciso ver se na colecao nova tem mais elementos para colocar no toAdd
			foreach ($newCollection as $value) {
				// Se o objeto da nova colecao nao existe no toAdd, acrecente-o no mesmo.
				if(!in_array($value, $toAdd))
					$toAdd[] = $value;
			}

			// Fazendo a magica =]
			$service->deleteCollection($toRemove);
			$service->addCollection($toAdd);
		}

	}

}

?>