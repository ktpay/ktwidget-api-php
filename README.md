# API Client

## Base usage

```php
$appID = "xxx";
$appKey = "xxx";
$apiRequest = new \KTpay\Api\Request($appID, $appKey);

$response = $apiRequest->nameOfApiMethod(['data' => []]);

if (!$response->success()) {
    var_dump($response->message());
    die();
}

var_dump($response->data())
```

### Payment create
```php
$response = $apiRequest->paymentCreate([
    'amount' => 200.00
]);
```