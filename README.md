#  bas-inception (Inception) Module for Zend Framework 2

bas-inception is a module for Zend Framework 2 geared towards quick & easy Doctrine Entity generation. This module is already pre-configured and should only need calling the service and passing in your php array.

## Requirements
 - PHP 5.3 or higher
 - [Zend Framework 2](http://www.github.com/zendframework/zf2)
 - [Doctrine Module](https://www.github.com/doctrine/DoctrineModule)
 - [Doctrine ORM Module](https://github.com/doctrine/DoctrineModule)

## Installation

Installation of bas-inception uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

#### Installation steps

  1. `cd my/project/directory`
  2. create a `composer.json` file with following contents:

     ```json
     {
         "require": {
             "bragg-about-systems/bas-inception": "dev-master"
         }
     }
     ```
  3. install composer via `curl -s http://getcomposer.org/installer | php` (on windows, download
     http://getcomposer.org/installer and execute it with PHP)
  4. run `php composer.phar install`
  5. open `my/project/directory/configs/application.config.php` and add the following key to your `modules`:

     ```php
     'Inception',
     ```

#### Basic Usage  (Actually the only usage you need -- its that simple!)

```php
// example of data that is used to populate your entities
              
// array keys represent your entities, the ServiceManager needs to be able to instantiate them
// $this->sm->get('ContactInfo'); It assumes your using PascalCase (may change later)
$data = array('contactInfo' => 

                // array values represent an array to populate your entity with
                array('contactInfoId' => 4478657, 
                      'firstName'     => 'mega', 
                      'lastName'      => 'man', 
                      'address'       => '465465465', 
                      'zip'           => 65202, 
                      'email'         => 'meep@lol.com', 
                      'overseas'      => 'not answered', 
                      
                      // In this example I use this as a Doctrine reference
                      //$this->entityManager->getReference('Doctrine\Entity', 5533);
                      'cities'        => array('cityId'    => 5533, 
                                               'cityName'  => 'columbia', 
                                               'county'    => 'boone', 
                                               'countyId'  => 473, 
                                               'latitude'  => 38, 
                                               'longitude' => -92, 
                                          ), 

                      // Phone Numbers is an Array Collection there is nothing extra you have to do 
                      // in order to create an Array Collection besides setting 
                      // new ArrayCollection() in the constructor of your entity class
                      'phoneNumbers' => array(
                                          array('phoneNumberId'   => 5774480, 
                                                'phoneNumberType' => 'not given', 
                                                'phoneNumber'     => '6547984652', 
                                                'phoneOrder'      => 'primary', 
                                                'bestTime'        => '', 
                                                'goodNumber' => 1, 
                                              ),
                                          array('phoneNumberId' => 0, 
                                                'phoneNumberType' => 'not given', 
                                                'phoneNumber' => '2564897456', 
                                                'phoneOrder' => 'cell', 
                                                'bestTime' => '', 
                                                'goodNumber' => 1, 
                                              ), 
                                        ), 

                      'financialInfo' => array('financialInfoId' => 3667432, 
                                               'creditRating' => '', 
                                               'grossIncome' => 0, 
                                               'bankruptcy' => '', 
                                               'totalAssets' => 0, 
                                               'latePayments' => false, 
                                               'monthlyDebtPayment' => 0, 
                                               'currentRate' => '0.0000', 
                                               'homeOwner' => false, 
                                               'occupationalStatus' => 'Employed', 
                                               'otherLatePayments' => '0', 
                                               'denyReason' => 'not_denied', 
                                               'denyNote' => 1, 
                                               'mortgagePayments' => false, 
                                               'bIncome' => 0, 
                                               'cbIncome' => 0, 
                                               'rateTrigger' => '0.0000', 
                                               'pulledCredit' => 'unknown', 
                                               'renting' => 0, 
                                        ), 
                      ), 
        )
```
In order to use a Doctrine reference you need to create an array with the references you 
want Doctrine to create.  Use a key called 'resources' to pass in your references. 
References can either use an Integer as the value or a key from your data array if the 
value is unknown at the time.

In this example I am using a key to have the value replaced from my data array above.

```php

$config = array('resources' => 
                  array('cities' => array('\\Entities\\Bas\\Cities' => 'cityId') 
          );
```
To access the inception creator, use the service locator:
```php

// for example, in a controller:
$inception = $this->getServiceLocator()->get('inception.creator');

// Pass in your data array and your config array into initialize method
// It will return an EntityInception object to be able to inspect the objects values. 
$entity_inception = $inception->initialize($data, $config);

// To get your entities just call getEntity()
$entities = $entity_inception->getEntity();

// If you dump your entities to the screen you will see your entities
// built with array collections, associations, and doctrine references
var_dump($entities);die();

//  Next all you need to do is persist and flush
$this->entity_manager->persist($entities);
$this->entity_manager->flush(); 





