<?php

return array(
    
    'factories' => array(
         
        'inception.array.collection' => function($sm) {
            $inception_array_collection = new Inception\Creator\InceptionArrayCollection($sm);
            return $inception_array_collection;
        }, 

        'inception.creator' => function($sm) {
            $factory = $sm->get('inception.factory');    
            $creator = new Inception\Creator($sm, $factory);

            return $creator;
        },

        'inception.entity.reference' => function($sm) {
            $em = $sm->get('doctrine.entitymanager.orm_default');
            $inception_reference = new Inception\Creator\InceptionEntityReference($sm, $em);
            return $inception_reference;
        },

        'entity.inception' => function($sm) {
            $em       = $sm->get('doctrine.entitymanager.orm_default');
            $factory  = $sm->get('inception.factory');
            $creator  = new Inception\Creator\EntityInception($sm, $em, $factory);
            return $creator;
        },

        'inception.factory' => function($sm) {
            $factory = new Inception\Creator\Factories\InceptionFactory($sm); 
            return $factory;
        },

    ),

    'invokables' => array(
        'array.collection' => 'Doctrine\Common\Collections\ArrayCollection',
        'entity.builder'   => 'Inception\Services\EntityBuilder'
    ),

    'shared' => array(

        'entity.builder'              => false,
        'inception.array.collection'  => false,
        'inception.creator'           => false,
        'entity.inception'            => false
    ),

    
);