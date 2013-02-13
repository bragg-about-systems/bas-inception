<?php

namespace Inception\Creator\Factories;

use Inception\Creator\Interfaces\InceptionInterface;

class InceptionFactory {
	
	protected $sm;

	public function __construct($sm) {
		$this->sm = $sm;
		
	}

	public function createEntityInception(array $data_array, $parent = null, array $config = array()) {
		
		$inception   = $this->sm->get('EntityInception');
		$creation    = $inception->initialize($data_array, $parent, $config);

		return $creation;
	}

	public function createInceptionArrayCollection(array $data_array, InceptionInterface $parent) {

		$inception_array_collection = $this->sm->get('InceptionArrayCollection');

		$inception_array_collection->initialize($data_array, $parent);

		return $inception_array_collection;
	}

	public function createInceptionEntityReference(array $data_array, array $reference) {
		$inception_reference = $this->sm->get('InceptionEntityReference');

		$inception_reference->initialize($data_array, $reference);

		return $inception_reference;
	}

}