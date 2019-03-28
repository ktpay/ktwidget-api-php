# KTWidget API client (Language PHP)

### Installation
- First download and install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos).
- In our project root directory
```bash
[user@localhost /var/www/my-awesome-project]$ composer require ktpay/xxx
```
- If your project has not been used `composer` before
    - Load `require_once __DIR__ . './vendor/autoload.php';` bootstrap in our "main" file 
    - Then use it

### Base usage
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

#### Payment create
```php
$response = $apiRequest->paymentCreate([
    'amount' => 200.00
]);
```