# example

```php
$spaceSpecs = include __DIR__ . '/resources/specs/space.php';

// space == ecosystem, blockchain, etc
$mySpace = new Space($spaceSpecs);

////////////////////////////////////////// v0 /////////////////////////////
// object == contract
$I = new Object([...]);

$car = new Object([...]);

// $I, $car should pay to space for registering
// or some dispatcher should do it?
$mySpace->register($I, $car);

// $I pays to the $car for using it
// own - it is like a smart-contract function
$I->own($car);

$He = new Object([...]);

$mySpace->register($He);

// $He pays to $I by function `bought`
$He->from($I)->bought($car);
//alter
$He->send(10, $I);
$He->own($car);

$object = $mySpace->createObject([...], $I); // vs new Object(...) ?
$treasure = $mySpace->mint(10, $I);// vs new Treasure(...)?
$mySpace->send($treasure, $object); //vs $object->receiveTreasure($treasure);

echo $mySpace->getObjectTreasures($object); // vs $object->getTreasures();

////////////////////////////////////////// v1 /////////////////////////////

$contract = new Contract([...])
$mySpace->register($contract); //contract pays for registration
$I = $contract->createOwner([...]); // IObject // contract pays for calculations
$car = $contract->createCar([...]); // IObject // contract pays for calculations
$bill = $contract->sell($car)->to($I)->commit(); // contract pays for calculations
$contract->store($I, $car, $bill); // contract pays for storing

$contract2 = new Contract([...]);
$He = $contract2->createOwner([...]);
$bill2 = $contract->from($He)->sell($car)->to($I)->commit();
$contract->store($bill2); // from this moment bill2 information is accessable for $contract2

```

```php

class Space {
    protected array $config = [
        'private_key' => '...',
        'public_key' => '...',
        'specs' => [
            'object' => [
                'create' => 'some\\class\\object'
            ]
        ]
    ];

    public function createObject(array $specs, IObject $actor)
    {
        $builder = new $this->config['specs']['object']['create']($specs);
    }
}
```