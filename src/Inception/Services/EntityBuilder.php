<?php
namespace Inception\Services;

use Inception\Creator\Interfaces\InceptionInterface, 
	Inception\Creator\EntityInception;

class EntityBuilder {
	
	protected $entity_inception;

	protected $doc_blocks;

	protected $reflection_class;

	protected $reflection_properties;

	public function initialize(\Inception\Creator\Interfaces\InceptionInterface $entity_inception) {

		$this->setEntityInception($entity_inception);
		$this->setReflectionClass();
		
		
		return $this;	
	}

	/**
     * EntityInception 
     *
     * @return void
     */
	public function setEntityInception(\Inception\Creator\Interfaces\InceptionInterface $entity_inception) {
		$this->entity_inception = $entity_inception;
	}

	public function getEntityInceptionObject() {
		return $this->entity_inception;
	}

	/**
     * Creates and Sets new reflection object from Entity on EntityInception
     *
     * @return void
     */
	public function setReflectionClass() {

		$this->reflection_class = new \ReflectionClass(get_class($this->entity_inception->getEntity()));
		$this->normalizeReflectionProperties($this->reflection_class);
	}

	/**
     * Returns reflection object of Entity
     *
     * @return ReflectionClass
     */
    public function getReflectionClass() {       
	    
	    return $this->reflection_class;
	}

	/**
     * Takes a reflection class to get its properties and calls properties setter
     *
     * @return ReflectionClassProperties
     */
	public function normalizeReflectionProperties(\ReflectionClass $reflection_class) {
		
		$reflection_properties = $reflection_class->getProperties();
		
		$property_array = array();
		foreach($reflection_properties as $index => $reflection_object) {

			$property_array[$reflection_object->getName()] = $reflection_object;
		}

		return $this->setReflectionProperties($property_array);

	}

	/**
     * Sets reflection property objects and calls NormalizeDocBlock  
     *
     * @return void
     */
	public function setReflectionProperties($reflection_properties) {
		
		$this->reflection_properties = $reflection_properties;
		$this->normalizeDocBlocks($this->reflection_properties);
	}

	public function getReflectionProperties() {
		return $this->reflection_properties;
	}

	public function normalizeDocBlocks($reflection_properties) {

		$doc_blocks = array();
		foreach($reflection_properties as $property_name => $object) {
			$doc_blocks[$property_name] = $object->getDocComment();
		}

		$this->setPropertyDocBlocks($doc_blocks);
	}

	public function setPropertyDocBlocks(array $doc_blocks) {

		$this->doc_blocks = $doc_blocks;	
	}

	public function getPropertyDocBlocks() {
		return $this->doc_blocks;
	}

	public function getPropertyDocBlock($property) {
		
		return $this->doc_blocks[$property];
	}

	public function isPropertyId($property) {
		$doc_block = $this->getPropertyDocBlock($property);
		
		preg_match('#@(?:.*?)GeneratedValue#', $doc_block, $annotations);
        
        if(!empty($annotations)) {
        	$annotations = true;
        } else {
        	$annotations = false;
        }

        return $annotations;
	}

	public function getPropertiesNeedParents() {
		
		$doc_blocks = $this->getPropertyDocBlocks();
		$needs_parent_array = array();

		foreach($doc_blocks as $property_name => $doc_block) {
			
			preg_match('#@(?:.*?)inversedBy#', $doc_block, $annotations);

			if(!empty($annotations)) {
	        	$needs_parent_array[$property_name] = $doc_block;
	        }
		}

        return $needs_parent_array;	
	}

	public function getEntityInception() {
		
		return $this->mergeEntityData();
	}

	protected function mergeEntityData() {

		$entity      = $this->entity_inception->getEntity();
		$entity_data = $this->entity_inception->getEntityData();

		if($this->entity_inception->hasArrayCollection()) {
			$array_collection_objects = $this->entity_inception->getArrayCollection();
			
			foreach($array_collection_objects as $object_property => $array_object) {
				
				if(array_key_exists($object_property, $entity_data)) {
					$entity_data[$object_property] = $array_object->getMergedData();
				}
				
			}
		}
		
		if($this->entity_inception->hasReferences()) {
			$reference_objects = $this->entity_inception->getReferences();

			foreach($reference_objects as $reference_property => $reference_object) {
				if(array_key_exists($reference_property, $entity_data)) {
					$entity_data[$reference_property] = $reference_object->getMergedData();
				}
			}
		}

		if($this->entity_inception->hasEntityInceptions()) {
			$child_entity_inceptions = $this->entity_inception->getMergedEntityInceptions();

			foreach($child_entity_inceptions as $child_inception_name => $child_inception) {
				if(array_key_exists($child_inception_name, $entity_data)) {
					$entity_data[$child_inception_name] = $child_inception->getMergedData();
				}
			}
		}

		if($this->entity_inception->needsParents()) {
			$entity = $this->setParentInceptions($entity);
		}

		return $this->buildFromArray($entity, $entity_data);
	}

	public function buildFromArray($entity, array $entity_data) {
        
     	foreach($entity_data as $property_name => $property_value) {
			
			if(!$this->isPropertyId($property_name)) {
				
				$setter = 'set' . ucfirst($property_name);
				
				if(method_exists($entity, $setter)) {
					
					$entity->$setter($property_value);	
				} else {
					
					throw new \RuntimeException("Unable to populate `{$property_name}` on `{$this->entity_inception->getInceptionName()}` Entity . Please implement {$setter}().");
				}

			}

		}

		return $entity; 
    }

    public function setParentInceptions($entity) {

    	$parents_array = $this->entity_inception->getNeedsParentsArray();

    	foreach($parents_array as $property_name => $doc_block) {

	        $setter = 'set' . ucfirst($property_name);
	        
	        if(method_exists($entity, $setter)) {
	            $parent = $this->entity_inception->getParent();

	            $entity->$setter($parent->getEntity());

	        } else {
	    
	            throw new \RuntimeException("Unable to populate `{$property_name}` on `{$this->entity_inception->getInceptionName()}` Entity . Please implement {$setter}().");
	        }
	    }

	    return $entity;
    }

}