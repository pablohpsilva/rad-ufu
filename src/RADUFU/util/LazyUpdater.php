<?php
namespace RADUFU\Service;

class LazyUpdater{
	
	public static function lazyUpdaterJob($oldCollection,$newCollection,$service){
		if(!empty($oldCollection) && !is_null($newCollection) || !empty($newCollection)){
			$toRemove = array();
			$toAdd = array();

			foreach ($oldCollection as $val) {
				if(in_array($val, $newCollection))
					$toAdd[] = $val;
				else
					$toRemove[] = $val;
			}

			foreach ($newCollection as $value) {
				if(!in_array($value, $toAdd))
					$toAdd[] = $value;
			}
			
			$service->deleteCollection($toRemove);
			$service->addCollection($toAdd);
		}

	}

}

?>