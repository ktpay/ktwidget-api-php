# KTWidget API client (Language PHP)
[![pipeline status](https://gitlab.com/nplustech/ktwidget-sdk-php/badges/master/pipeline.svg)](https://gitlab.com/nplustech/ktwidget-sdk-php/commits/master)
[![coverage report](https://gitlab.com/nplustech/ktwidget-sdk-php/badges/master/coverage.svg)](https://gitlab.com/nplustech/ktwidget-sdk-php/commits/master)

### Installation
First download and install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos).
In our project root directory
```bash
composer require ktpay/ktwidget-api-php
```
On production environment
```bash
composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader
```
If your project has not been used `composer` before:
  - Load `require_once __DIR__ . './vendor/autoload.php';` bootstrap in our "main" file 
  - Then use it

### Base usage
```php
$appID = "xxx";
$appKey = "xxx";
$apiRequest = new \KTWidget\Merchant\Request($appID, $appKey);

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
    "order" => [
        "amount" => 1000,
        "order_id" => "Order1",
        "description" => "Тестовая оплата за Order1",
        "callback_back_url" => "https://our.store.kz",
        "type" => "ecom",
    ],
    "user" => [
        "merchant_user_id" => "user1",
        "phone" => "+77001234567",
        "email" => "test@example.com",
    ]
]);
```
### Tests
Run this
```bash
[user@localhost xxx]$ KTPAYAPI_APP_KEY=xxx;KTPAYAPI_KEY=yyy phpunit
```
Or add environments into config file `phpunit.xml`
```xml
<phpunit>
    ...
    <php>
        <env name="KTPAYAPI_APP_KEY" value="xxx"/>
        <env name="KTPAYAPI_KEY" value="yyy"/>
    </php>
    ...
</phpunit>
```
