<?php 

namespace SecondaryApproval\Objects;

interface CreationInterface {

     

     
     /**
     * Gets the Entity Properties that need to be skipped while building parent child asscociations
     * @return array  
     */
     public function getAssociationSkips();

     /**
     * Returns Array of Specific Entities to use in Lead Creation
     *
     * @return array
     */
     public function getLeadMappings();

     /**
     * Returns Array of Entity Resources
     *
     * @return array
     */
     public function getResources();

     

}