<?php

namespace Inception;

use Phake,
	Inception\InceptionTestCase;

class CreatorTest extends InceptionTestCase {


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

    	$actual_entity_inception = $this->inception_creator->initialize(array());
    	
    	$this->assertInstanceOf('Inception\Creator\EntityInception', $actual_entity_inception);
    	
    	
    }

    


}