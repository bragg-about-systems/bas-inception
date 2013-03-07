<?php
namespace Inception;

class Creator {
	
  protected $inception_factory;

  public function __construct($factory) {
      $this->inception_factory = $factory;
  } 

  public function initialize(array $data_array, array $config = array()) {
      
      $entity_inception = $this->inception_factory->createEntityInception($data_array, null, $config);
      
      return $entity_inception;
  }  
    
}