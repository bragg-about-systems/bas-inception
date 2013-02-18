<?php
namespace Inception\Creator;

use Inception\Creator\Interfaces\InceptionInterface, 
    Doctrine\Common\Collections\ArrayCollection;

class EntityInception implements InceptionInterface {

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
     * currently referrences to Doctrine Objects -- could be other options to set
     *
     * @var array
     */
    protected $config;

    /**
     * actual Doctrine Entity used
     *
     * @var object
     */
    protected $entity;

    /**
     * array of data to populate Doctrine Entity with
     *
     * @var array
     */
    protected $entity_data;

    /**
     * specific merged object
     *
     * @var object
     */
    protected $merged_data;

    /**
     * @var bool
     */
    protected $has_entity_inceptions = false;

    /**
     * array of merged data 
     *
     * @var array
     */
    protected $merged_entity_inceptions;

    /**
     * @var bool
     */
    protected $has_reference = false;

    /**
     * array of referrences to populate
     *
     * @var array
     */
    protected $entity_references = array();

    /**
     * @var bool
     */
    protected $has_array_collection = false;

    /**
     * @var array
     */
    protected $array_collection = array();

    /**
     * 
     *
     * @var bool
     */
    protected $needs_parents = false;

    /**
     * array of properties that needs a parent
     *
     * @var array
     */
    protected $needs_parent_array;

    /**
     * parent entity inception
     *
     * @var object
     */
    protected $parent;

    /**
    *  child inception of parent object 
    *
    *  @var Inception\Creator\EntityInception
    */
    protected $child_inception;

    /**
    *  Doctrine object to introspect entities to collect metadata 
    *
    *  @var Doctrine\ORM\Mapping\ClassMetadataFactory
    */
    protected $metadata_inspector;

    /**
    *  Inception factory that creates new entity inceptions 
    *
    *  @var Inception\Creator\Factories\InceptionFactory
    */
    protected $inception_factory;

    /**
    *  @var Inception\Services\EntityBuilder
    */
    protected $entity_builder;

    public function __construct($sm, $em, $factory) {
        
        $this->sm                 = $sm;
        $this->em                 = $em;
        $this->inception_factory  = $factory;

        $this->metadata_inspector = $this->em->getMetadataFactory();
        $this->entity_builder     = $this->sm->get('entity.builder');
        
    }

    public function initialize($data_array, $parent, $config) {
    	
        $this->setUpObject($data_array, $parent, $config);
        
        $this->buildChildren();

        $this->entity_builder->initialize($this);
        $this->setNeedsParent();

        $this->setMergedData($this->entity_builder->getEntityInception());

        $this->destroy();
        return $this;
    }

    protected function setUpObject($data_array, $parent, $config) {

        $object_name = key($data_array); 
        
        $this->setInceptionName(ucfirst($object_name));
        
        $this->setEntityData($data_array[$object_name]);

        $this->setConfig($config);

        $this->setEntity();

        $this->setParent($parent);

        return $this;   
    }

    protected function setConfig($config) {
        
        $this->config = $config;
    }

    public function getConfig() {
        return $this->config;
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

    public function getEntityDataByKey($key) {
        $data = $this->getEntityData();
        if(array_key_exists($key, $data)) {
            return $data[$key];
        }
    }

    public function setMergedData($data) {
        $this->merged_data = $data;
    }

    public function getMergedData() {
        return $this->merged_data;
    }

    protected function setEntity() {
        
        $entity_name = $this->getInceptionName();
        
        $this->entity = $this->getNewEntity($entity_name);
    }

    public function getNewEntity($entity_name) {
        
        if($this->sm->has($entity_name)) {
            $new_entity = $this->sm->get($entity_name);
        } else {
            throw new \RuntimeException("Unable to create Entity `{$entity_name}`. Check your Service Manager Configuration is setup correctly");
        }

        return $new_entity;   
    }

    /**
     * returns Doctrine Entity
     *
     * @return object
     */
    public function getEntity() {
        return $this->entity;
    }

    protected function setParent($parent) {
        $this->parent = $parent;
    }

    public function getParent() {
        return $this->parent;
    }

    protected function setNeedsParent() {
        
        $this->needs_parent_array = $this->entity_builder->getPropertiesNeedParents();

        if(!empty($this->needs_parent_array)) {
            $this->needs_parents = true;
        }
        return $this;
    }

    public function needsParents() {
        return $this->needs_parents;
    }

    public function getNeedsParentsArray() {
        return $this->needs_parent_array;
    }

    //TODO:  Remove these methods and refactor if being used
    // protected function setChildEntityInception($entity_inception) {
    //     $this->child_inception = $entity_inception;
    // }

    // public function getChildEntityInception() {
    //     return $this->child_inception;
    // }

    protected function addArrayCollection($collection_name, \Inception\Creator\InceptionArrayCollection $array_collection) {

        $this->array_collection[$collection_name] = $array_collection;
        $this->setHasArrayCollection(true);
    }

    public function getArrayCollection() {
        return $this->array_collection;
    }

    protected function setHasArrayCollection($bool) {
        $this->has_array_collection = $bool;
    }

    public function hasArrayCollection() {
        return $this->has_array_collection;
    }

    protected function addEntityReference($reference_name, \Inception\Creator\InceptionEntityReference $inception_reference) {

        $this->entity_references[$reference_name] = $inception_reference;
        $this->setHasEntityReferences(true);
    }

    protected function setHasEntityReferences($bool) {
        
        $this->has_reference = $bool;
    }

    public function getReferences() {
        
        return $this->entity_references;
    }

    public function hasReferences() {
        return $this->has_reference;
    }

    public function addEntityInception($inception_name, InceptionInterface $entity_inception) {
        
        $this->merged_entity_inceptions[$inception_name] = $entity_inception;
        $this->setHasEntityInceptions(true);   
    }

    public function setHasEntityInceptions($bool) {
        $this->has_entity_inceptions = true;
    }

    public function getMergedEntityInceptions() {
        return $this->merged_entity_inceptions;
    }

    public function hasEntityInceptions() {
        return $this->has_entity_inceptions;
    }

    /**
     * returns entire class name with namespace
     *
     * @return string
     */
    public function getEntityNamespace($entity) {
        return get_class($entity);
    }

    /**
     * returns class name without the namespace
     *
     * @return string
     */
    public function getEntityClassName($entity) {
        
        $class = explode('\\', $this->getEntityNamespace($entity));
        
        return end($class); 
    }

    /**
     * Recursively checks for child entities -- when found creates new EntityInception with merged data
     *
     * @return EntityInception
     */
    protected function buildChildren() {
        
        $data = $this->getEntityData();
        
        foreach($data as $property_name => $property_values) {
            
            $getter = 'get' . ucfirst($property_name);
            
            //TODO:  Move this into a method isPropertyArrayCollection($entity, $getter) 
            if(method_exists($this->entity, $getter)) {
                
                $is_array_collection = is_a($this->entity->$getter(), 'Doctrine\Common\Collections\ArrayCollection');

                if($is_array_collection) {
                
                    $array_collection = array($property_name => $property_values);
                    $inception_array  = $this->inception_factory->createInceptionArrayCollection($array_collection, $this);
                    
                    $this->addArrayCollection($property_name, $inception_array);
                } else {
                    $is_array_collection = false;
                }

                if(!$is_array_collection) {
                    
                    if(array_key_exists('resources', $this->config)) {
                        if(array_key_exists($property_name, $this->config['resources'])) {
                            $is_entity_reference = true;

                            $reference_data = $this->config['resources'][$property_name];
                            $new_creation   = array($property_name => $this->getEntityDataByKey($property_name));

                            $inception_reference = $this->inception_factory->createInceptionEntityReference($new_creation, $reference_data);
                            
                            $this->addEntityReference($property_name, $inception_reference);
                        }
                    }
                }

            }    
            
            if($this->sm->has(ucfirst($property_name)) && !$is_array_collection && !$is_entity_reference) {
                
                $new_creation  = array($property_name => $property_values);
                
                $new_inception = $this->inception_factory->createEntityInception($new_creation, $this, $this->getConfig());
                    
                $this->addEntityInception($property_name, $new_inception);
    
            }

            $is_array_collection = false;
            $is_entity_reference = false;

        }
        
        
        return $this;    
    }

    /**
     * Removes varaibles that use recursion
     *
     * @return EntityInception
     */
    public function destroy() {
        
        $this->sm                 = null;
        $this->em                 = null;
        $this->inception_factory  = null;
        $this->metadata_inspector = null;

        if($this->parent != null) {
            $this->parent->destroy();
        }
        return $this;
    }

}
