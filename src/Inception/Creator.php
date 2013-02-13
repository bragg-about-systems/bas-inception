<?php
namespace Inception;

class Creator {
	
  protected $sm;

  protected $inception_factory;

  protected $entities;
  
  public function __construct($sm, $factory) {
      $this->sm                = $sm;
      $this->inception_factory = $factory;

  } 

  public function initialize(array $data_array, array $config = array()) {
      
      $entity_inception = $this->inception_factory->createEntityInception($data_array, null, $config);
      
      return $entity_inception;
  }  
    
}