<?php
namespace Inception;

use Phake;
use Inception\Creator;
use Inception\Creator\EntityInception;
use Inception\Creator\Factories\InceptionFactory;
use PHPUnit_Framework_TestCase;


class InceptionTestCase extends PHPUnit_Framework_TestCase {
	
	/**
     * @var \Inception\Creator
     */
    private static $inceptionCreator;

	/**
     * @var \Inception\Creator\EntityInception
     */
    private static $entityInception;

    /**
     * @var \Inception\Creator\Factories\InceptionFactory
     */
    private static $inceptionFactory;

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    private static $serviceManager;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private static $entityManager;

    public function __construct() {

        self::setEntityManager(Phake::mock('Doctrine\ORM\EntityManager'));
        self::setServiceManager(Phake::mock('Zend\ServiceManager\ServiceManager'));
        self::setInceptionFactory(Phake::mock('Inception\Creator\Factories\InceptionFactory'));
        
        self::setInceptionCreator(new Creator(self::$inceptionFactory));
        self::setEntityInception(new Creator\EntityInception(self::$serviceManager, self::$entityManager, self::$inceptionFactory));   
    }

    /**
     * @param \Zend\ServiceManager\ServiceManager
     */
    public static function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager) {
        self::$serviceManager = $serviceManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager
     */
    public static function setEntityManager(\Doctrine\ORM\EntityManager $entityManager) {
        self::$entityManager = $entityManager;
    }

    /**
     * @param \Inception\Creator\Factories\InceptionFactory
     */
    public static function setInceptionFactory(InceptionFactory $inceptionFactory) {
        self::$inceptionFactory = $inceptionFactory;
    }

    /**
     * @param \Inception\Creator
     */
    public static function setInceptionCreator(Creator $inceptionCreator) {
        self::$inceptionCreator = $inceptionCreator;
    }

    /**
     * @param \Inception\Creator\EntityInception
     */
    public static function setEntityInception(EntityInception $entityInception) {
        self::$entityInception = $entityInception;
    }

    /**
     * @return \Inception\Creator
     */
    public function getInceptionCreator() {
        return self::$inceptionCreator;
    }

    /**
     * @return \Inception\Creator
     */
    public function getEntityInception() {
        return self::$entityInception;
    }

    /**
     * @return \Inception\Creator\Factories\InceptionFactory
     */
    public function getInceptionFactory() {
        return self::$inceptionFactory;
    }

}