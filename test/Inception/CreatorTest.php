<?php

namespace Inception;

use Phake,
	Inception\InceptionTestCase;

class CreatorTest extends InceptionTestCase {

	protected $em;

    protected $sm;

    protected $inception_factory;

    public function setUp() {
    	$this->em                = Phake::mock('Doctrine\ORM\EntityManager');
        $this->sm                = Phake::mock('Zend\ServiceManager\ServiceManager');
        $this->inception_factory = Phake::mock('Inception\Creator\Factories\InceptionFactory');
        
        $this->inception_creator = new Creator($this->sm, $this->inception_factory);
        $this->entity_inception  = new Creator\EntityInception($this->sm, $this->em, $this->factory);

    }

    public function testFoo(){
    	$expected = "foo";
    	$data = array('HERE IS MY Data');
		Phake::when($this->inception_factory)->createEntityInception($data, null, $this->anything())->thenReturn($expected);

		$actual = $this->inception_creator->initialize($data);

		$this->assertSame($expected, $actual);
    }

    public function testInitializeReturnsRightTypeObject() {

    	$data_array = array('cities' => array ( 
						  		'cityId'    => 5533, 
						  		'cityName'  => 'columbia', 
						  		'county'    => 'boone', 
						  		'countyId'  => 473, 
						  		'latitude'  => 38, 
						  		'longitude' => -92, 
		  				));

    	Phake::when($this->inception_factory)->createEntityInception($this->anything(), null, $this->anything())->thenReturn($this->entity_inception);

    	$actual_entity_inception = $this->inception_creator->initialize($data_array);
    	
    	$this->assertInstanceOf('Inception\Creator\EntityInception', $actual_entity_inception);
    	
    	
    }

    


}