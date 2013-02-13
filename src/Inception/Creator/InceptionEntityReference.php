<?php
namespace Inception\Creator;

use Inception\Creator\Interfaces\InceptionInterface;

class InceptionEntityReference implements InceptionInterface {

	/**
     * @var Zend\ServiceManager
     */
    protected $sm;

    /**
    *  @var Doctrine\ORM\EntityManager
    */
    protected $em;

    /**
     * @var string
     */
    protected $inception_name;

    /**
     * array of data to populate Doctrine Entity with
     *
     * @var array
     */
    protected $entity_data;

    /**
     * array of merged data 
     *
     * @var array
     */
    protected $merged_data;

    /**
     * actual Doctrine Entity used
     *
     * @var object
     */
    protected $entity;

    /**
     * array of doctrine referrence to populate Doctrine Entity with
     *
     * @var array
     */
    protected $entity_reference = array();

    public function __construct($sm, $em) {
        $this->sm = $sm;
        $this->em = $em;
    }

    public function initialize($data_array, $reference) {
        
        $this->setUpObject($data_array, $reference);
        $this->destroy();
        return $this;
    }

    public function setUpObject($data_array, $reference) {
        
        $object_name = key($data_array); 
        
        $this->setInceptionName(ucfirst($object_name));

        $this->setEntityReference($reference);
        
        $this->setEntity();

        $this->setEntityData($data_array[$object_name]);

        $this->convertReferences();

        return $this;
    }

    protected function setInceptionName($object_name) {
        $this->inception_name = $object_name;
    }

    public function getInceptionName() {
        return $this->inception_name;
    }

    protected function setEntityData($data) {
        $this->entity_data = $data;
    }

    public function getEntityData() {
        return $this->entity_data;
    }

    protected function setMergedData($data) {
        $this->merged_data = $data;
    }

    public function getMergedData() {
        return $this->merged_data;
    }

    protected function setEntity() {
        
        $entity_name = $this->getInceptionName();
        $this->entity = $this->sm->get($entity_name);
    }

    public function getEntity() {
        return $this->entity;
    }

    protected function setEntityReference($reference) {
        
        $this->entity_reference = $reference;
    }

    public function getEntityReference() {
        return $this->entity_reference;
    }

    protected function convertReferences() {

        $entity_data   = $this->getEntityData();
        $reference     = $this->getEntityReference();

        $entity_key    = key($reference);
        $property_key  = $reference[$entity_key];
        
        if(is_string($property_key)) {
                   
            $reference_id = $entity_data[$property_key];
        } else {

            $reference_id = $reference[$entity_key];
        }

        $entity_reference = $this->em->getReference($entity_key, $reference_id);
        
        $this->setMergedData($entity_reference);

        return $this;
    }

    /**
     * Removes varaibles that use recursion
     *
     * @return EntityInception
     */
    public function destroy() {
        
        $this->sm = null;
        $this->em = null;
        
        return $this;
    }
}