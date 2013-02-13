<?php 

namespace Entities\Inception\Creator;

interface AbstractCreatorInterface {

     /**
     * Initializes the Lead Creation Object
     * @param $lead_data the actual data to initialize the object with
     * @param $force bool for repopulating the lead_data 
     */
     public function initialize(array $lead_data, $force);

     /**
     * Sets the Raw Lead Data being used for the Creation of the Lead
     */
     public function setRawLeadData(array $lead_data, $force);

     /**
     * Gets the Raw Lead Data being used for the Creation of the Lead
     */
     public function getRawLeadData();

     /**
     * Sets the Converted Lead Data
     */
     public function setLeadData(array $lead_data);

     /**
     * Gets the Converted Lead Data
     */
     public function getLeadData();

     /**
     * Sets the converted entity mapping for referrence
     * @param $entities array of converted entity mappings to set
     */
     public function setEntityMappings(array $entities);

     /**
     * Gets the converted entity mapping for referrence
     */
     public function getEntities();

	/**
     * Returns Array of Populated Entities
     *
     * @return array
     */
	public function populateEntityMappings();

     /**
     * Returns Lead Data after replacing value with Doctrine Proxy Referrences 
     * @param array
     * @return array
     */
     public function populateEntityResources();

     /**
     * Converts Entity Mapping into Entities through Asscociation
     * 
     */
     public function convertEntityMappings();

     /**
     * Returns Array of Populated Entities
     *
     * @return array
     */
     public function buildNewLeadEntity();

     /**
     * Returns the Base Entity with all its child asscociations Entities already created and set
     * @param $entity Doctrine Entity Object 
     * @return object
     */
     public function getAssociations($entity);

     /**
     * Returns an Object of Arrays with MetaData of the Doctrine Entity
     * @param $entity Doctrine Entity Object 
     * @return object
     */
     public function getMetadata($entity);

}