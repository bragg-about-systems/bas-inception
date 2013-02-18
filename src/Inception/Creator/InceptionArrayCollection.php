<?php
namespace Inception\Creator;

use Inception\Creator\Interfaces\InceptionInterface, 
    Doctrine\Common\Collections\ArrayCollection;

class InceptionArrayCollection implements InceptionInterface {

    /**
     * @var Zend\ServiceManager
     */
    protected $sm;

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
     * actual Doctrine Entity used
     *
     * @var object
     */
    protected $entity;

    /**
    *  @var Inception\Services\EntityBuilder
    */
    protected $entity_builder;

    public function __construct($sm) {
        $this->sm             = $sm;
        $this->entity_builder = $this->sm->get('entity.builder');
    }

    public function initialize($data_array, $parent) {
        
        $this->setUpObject($data_array, $parent);
        
        $this->entity_builder->initialize($this);
        $this->setNeedsParent();

        $this->buildArrayCollection();
        $this->destroy();
        return $this;
    }

    public function setUpObject($data_array, $parent) {
        
        $object_name = key($data_array); 
        
        $this->setInceptionName(ucfirst($object_name));
        
        $this->setEntity();

        $this->setEntityData($data_array[$object_name]);

        $this->setParent($parent);

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

    protected function setParent(InceptionInterface $parent) {
        $this->parent = $parent;
    }

    public function getParent() {
        return $this->parent;
    }

    protected function setEntity() {
        
        $entity_name = $this->getInceptionName();
        $this->entity = $this->sm->get($entity_name);
    }

    public function getEntity() {
        return $this->entity;
    }

    protected function setMergedData(\Doctrine\Common\Collections\ArrayCollection $data) {
        $this->merged_data = $data;
    }

    public function getMergedData() {
        return $this->merged_data;
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



    protected function buildArrayCollection() {

        $array_collection      = $this->sm->get('array.collection');
        $array_collection_data = $this->getEntityData();
        $parents_array         = $this->getNeedsParentsArray();


        foreach($array_collection_data as $index => $data_array) {
            
            if($this->sm->has($this->getInceptionName())) {
                
                $new_entity = $this->sm->get($this->getInceptionName());

                if(!empty($parents_array)) {
                    
                    foreach($parents_array as $property_name => $doc_block) {

                        $setter = 'set' . ucfirst($property_name);
                        
                        if(method_exists($new_entity, $setter)) {
                            $parent = $this->getParent();
                            
                            $new_entity->$setter($parent->getEntity());
                        } else {
                    
                            throw new \RuntimeException("Unable to populate `{$property_name}` on `{$this->getInceptionName()}` Entity . Please implement {$setter}().");
                        }
                    }
                }

                $new_entity = $this->entity_builder->buildFromArray($new_entity, $data_array);
                
                $array_collection->add($new_entity);

            } else {
                
                throw new \RuntimeException("Unable to create Entity `{$this->getInceptionName()}`. Check your Service Manager Configuration is setup correctly");
            } 
            
        }
        
        $this->setMergedData($array_collection);

        return $this;
    }

    /**
     * Removes varaibles that use recursion
     *
     * @return EntityInception
     */
    public function destroy() {
        
        $this->sm = null;
        
        return $this;
    }
}
