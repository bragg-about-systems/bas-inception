<?php
namespace Entities\Inception\Creator;
//TODO: Removing implementations right now to get things going
//implements AbstractCreatorInterface, CreationInterface
abstract class AbstractCreation  {

	protected $inception_factory;

    public function __construct($factory) {
           
    }

    public function initialize(array $raw_lead_data, $force = false) {

        // //$this->setRawLeadData($raw_lead_data);
        
        // //TODO: Hack because cannot pass resource into entity->buildFromArray needs a solution but this works for now
        // // Was calling populateEntityResources() before populateEntityMappings()
        // $this->setLeadData($raw_lead_data);
        
        // // TODO: put this in a method that calls something from the derived to set new lead
        // $this->new_lead = $this->sm->get('Leads');
        
        // $converted = $this->convertEntityMappings();
        
        // $populated = $this->populateEntityMappings();
        // //var_dump($populated);die();
        // //$resources = $this->populateObjectResources();

        // $resources = $this->populateEntityResources();
        // var_dump($resources);die();
        // return $this->buildNewLeadEntity();
    }

    public function convertEntityMappings() {

        // $entities     = array();
        // $mappings     = $this->getLeadMappings();
        // $resource_map = $this->getResourceMappings();
        
        // foreach($mappings as $mapping) {
            
        //     if(in_array(lcfirst($mapping), $resource_map)) {
        //         $entity = array();
        //         $entity_name = lcfirst($mapping);
        //     } else {
        //         $entity      = $this->sm->get($mapping);
        //         $entity      = $this->getAssociations($entity);
        //         $entity_name = lcfirst($entity->getWithoutNamespace());
        //     }

        //     $entities[$entity_name] = $entity;
        // }
        
        // return $this->setEntityMappings($entities);   
    }

    /**
     * Returns the Base Entity with all its child asscociations Entities already created and set
     * @param $entity Doctrine Entity Object
     * @return object
     */
    public function getAssociations($entity) {

        // $metadata     = $this->getMetadata($entity);
        // $entity_name  = lcfirst($entity->getWithoutNamespace());
        
        // if(!empty($metadata->associationMappings)) {

        //     $associationsMappings = $metadata->associationMappings;
        //     $entity_skips         = $this->getAssociationSkips();

        //     foreach($associationsMappings as $class => $properties) {

        //         $class_name = $class;
        //         $class      = $this->sm->get(ucfirst($class_name));
        //         $class_meta = $this->getMetaData($class);

        //         //TODO: This needs to go in a variable check for the times its empty (get undefined index)
        //         //$metadata->associationMappings[$class_name]['isOwningSide']
        //         if(empty($class_meta->associationMappings) && !in_array($class_name, $entity_skips)) {
                        
        //             $entity->__set($class_name, $class);
                        
        //         } else if($metadata->associationMappings[$class_name]['isOwningSide'] && !in_array($class_name, $entity_skips)) {
        //             $entity->__set($class_name, $this->getAssociations($class));
        //         }
        //     }
        // }

        // return $entity;
    }

    /**
     * Returns an Object of Arrays with MetaData of the Doctrine Entity
     * @param $entity Doctrine Entity Object
     * @return object
     */
    public function getMetadata($entity) {

        // if(is_subclass_of($entity, 'Entities\BaseEntity')) {
        //     return $this->em->getClassMetadata($entity->getEntityName());
        // } else {
        //     throw new \Exception("In Order to get MetaData Entity must Extend `Entities\BaseEntity`");
        // }
    }

    public function populateEntityMappings() {

        // $entities  = $this->getEntities();
        // $lead_data = $this->getLeadData();
        
        // foreach($entities as $entity_name => $entity) {
            
        //     if(!empty($entity)) {
        //         $entity->buildFromArray($lead_data[$entity_name]);
        //         $entities[$entity_name] = $entity;    
        //     }
               
        // }

        // return $this->setEntityMappings($entities);
    }

    public function populateObjectResources() {
        
        // $entities = $this->getEntities();
        // $object_resources = $this->getObjectResources();

        // foreach($entities as $entity_name => $entity) {
        //     if(array_key_exists($entity_name, $object_resources)) {
                
        //         $property   = key($object_resources[$entity_name]);
        //         $value      = $object_resources[$entity_name][$property];
        //         $entity->__set($property, $value);
        //     }
        // }
        
        // return $this->setEntityMappings($entities);
    }

    public function populateEntityResources() {

        // $entities     = $this->getEntities();   
        // $new_entities = array_replace_recursive($entities, $this->getResources());
        
        // return $this->setEntityMappings($new_entities);
    }

    public function setRawLeadData(array $raw_lead_data, $force = false) {
       
        // if(empty($this->raw_lead_data)) {

        //     $this->raw_lead_data = $raw_lead_data;

        // } else if(!empty($this->raw_lead_data) && $force == true) {
            
        //     $this->raw_lead_data = $raw_lead_data;

        // } else {
        //     throw new \Exception('In order to repopulate the data use the `force` parameter true');
        // }

        // return $this->raw_lead_data;

    }

    public function getRawLeadData() {
        //return $this->raw_lead_data;
    }

    public function setLeadData(array $lead_data) {
        // $this->lead_data = $lead_data;
        // return $this->lead_data;
    }

    public function getLeadData() {
        //return $this->lead_data;
    }

    public function setEntityMappings(array $entities) {
        // $this->entities = $entities;

        // return $this->entities;
    }

    public function getEntities() {
        //return $this->entities;
    }

    public function buildNewLeadEntity() {
        // $entities = $this->getEntities();
        
        // foreach($entities as $entity_name => $entity) {
        //     $this->new_lead->__set($entity_name, $entity);
        // }
        
        // return $this->new_lead;
    }

    // /**
    //  * Gets the Entity Properties that need to be skipped while building parent child asscociations
    //  * @return array  
    //  */
    //  abstract public function getAssociationSkips();

    //  *
    //  * Returns Array of Specific Entities to use in Lead Creation
    //  *
    //  * @return array
     
    //  abstract public function getLeadMappings();

    //  /**
    //  * Returns Array of Entity Resources
    //  *
    //  * @return array
    //  */
    //  abstract public function getResources();
}
