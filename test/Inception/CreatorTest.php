<?php

namespace Inception;

use Phake,
	Inception\InceptionTestCase;

class CreatorTest extends InceptionTestCase {

    protected $inceptionCreator;

    protected $inceptionFactory;

    protected $entityInception;
    
    public function setUp() {
        $this->inceptionCreator = $this->getInceptionCreator();
        $this->inceptionFactory = $this->getInceptionFactory();
        $this->entityInception  = $this->getEntityInception();
    }

    public function testFoo(){
    	$expected = "foo";
    	$data = array('HERE IS MY Data');
		Phake::when($this->inceptionFactory)->createEntityInception($data, null, $this->anything())->thenReturn($expected);

		$actual = $this->inceptionCreator->initialize($data);

		$this->assertSame($expected, $actual);
    }

    public function testInitializeReturnsRightTypeObject() {

    	Phake::when($this->inceptionFactory)->createEntityInception($this->anything(), null, $this->anything())->thenReturn($this->entityInception);

    	$actual_entity_inception = $this->inceptionCreator->initialize(array());
    	
    	$this->assertInstanceOf('Inception\Creator\EntityInception', $actual_entity_inception);
    	
    	
    }

    


}