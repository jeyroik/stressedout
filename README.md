# example

```php
$spaceSpecs = include __DIR__ . '/resources/specs/space.php';

// space == ecosystem, blockchain, etc
$mySpace = new Space($spaceSpecs);

$shopSample = new ContractSample([...]);
$ISample    = new ContractSample([...]);
$carSample  = new ContractSample([...]);

$shop = $mySpace->createContract($shopSample);
$I    = $mySpace->createContract($ISample);
$car  = $mySpace->createContract($carSample);

$transactionSample = $shop->sell($car, 100, $I); // create transaction sample (local transaction)
$transaction = $mySpace->createTransaction($transactionSample); // save transaction to a space
```