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

#### Service Locator  (Actual the only usage you need)
To access the inception creator, use the service locator:

```php
// for example, in a controller:
$inception = $this->getServiceLocator()->get('inception.creator');

// example of data that is used to populate your entities
$data = array('contactInfo' => 
                  array('contactInfoId' => 4478657, 
                        'firstName'     => 'mega', 
                        'lastName'      => 'man', 
                        'address'       => '465465465', 
                        'zip'           => 65202, 
                        'email'         => 'meep@lol.com', 
                        'overseas'      => 'not answered', 
                        
                        'cities'        => array('cityId'    => 5533, 
                                                 'cityName'  => 'columbia', 
                                                 'county'    => 'boone', 
                                                 'countyId'  => 473, 
                                                 'latitude'  => 38, 
                                                 'longitude' => -92, 
                                            ), 

                        'phoneNumbers' => array(
                                            array('phoneNumberId' => 5774480, 
                                                  'phoneNumberType' => 'not given', 
                                                  'phoneNumber' => '6547984652', 
                                                  'phoneOrder' => 'primary', 
                                                  'bestTime' => '', 
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

