<?php

return array(
    
    'factories' => array(
         
        'InceptionArrayCollection' => function($sm) {
            $inception_array_collection = new Creator\InceptionArrayCollection($sm);
            return $inception_array_collection;
        }, 

        'InceptionCreator' => function($sm) {
            $factory = $sm->get('InceptionFactory');    
            $creator = new Creator($sm, $factory);

            return $creator;
        },

        'InceptionEntityReference' => function($sm) {
            $em = $sm->get('doctrine.entitymanager.orm_default');
            $inception_reference = new Creator\InceptionEntityReference($sm, $em);
            return $inception_reference;
        },

        'EntityInception' => function($sm) {
            $em       = $sm->get('doctrine.entitymanager.orm_default');
            $factory  = $sm->get('InceptionFactory');
            $creator  = new Creator\EntityInception($sm, $em, $factory);
            return $creator;
        },

        'InceptionFactory' => function($sm) {
            $factory = new Creator\Factories\InceptionFactory($sm); 
            return $factory;
        },

        'DuplicateLeadConfig' => function($sm) {
            $config = new \Zend\Config\Config(array(), true);
            $config->resources = array();
            //$config->resources->leadPurpose = array('\Entities\Vamclo\LeadPurpose' => 'leadPurposeId');
            $config->resources->cities      = array('\Entities\Bas\Cities' => 'cityId');
            //$config->resources->statuses    = array('\Entities\Vamclo\Statuses' => 'statusId');
            // $config->resources->sites       = array('\Entities\Vamclo\Sites' => 'siteId');
            // $config->resources->tracking    = array('\Entities\Vamclo\Tracking' => 'siteId');
            // $config->resources->divisions   = array('\Entities\Vamclo\Divisions' => 4); 

            return $config;
        },
   
    ),

    'invokables' => array(
        'ArrayCollection' => 'Doctrine\Common\Collections\ArrayCollection',
        'EntityBuilder'   => 'Inception\Services\EntityBuilder'
    ),

    'shared' => array(

        'EntityBuilder'            => false,
        'InceptionArrayCollection' => false,
        'inception.creator'         => false,
        'EntityInception'          => false
    ),

    
);