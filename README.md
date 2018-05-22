# inpsyde

---
A composer package, which serves the functionality working with WordPress Nonce

- [Installation](#installation)
- [Requirements](#requirements)
- [Quick start and examples](#quick-start-and-examples)
- [Available Methods](#available-methods)

---

### Installation with composer

This SDK uses composer.

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

For more information on how to use/install composer, please visit: [https://github.com/composer/composer](https://github.com/composer/composer)

To install the package into your project, simply

	$ composer require rhamoudi/inpsyde
	

### Requirements

Php versions 5.6 and newer.

### Quick start and examples

```php
$base = new Base;
$base->createNonce('test_nonce');
$nonce_value = $base->getNonce();
```

# Available Methods
```php
$base = new Base;

$base->setNonce('test_nonce1')
    ->setAction('test_nonce')
    ->setErrors(true)
    ->setErrorMessage('Your WordPress Nonce is not valid');
```

### Get Nonce
```php
    ->getNonce();
```

### Get Action
```php
    ->getAction();
```

### Get Errors
```php
    ->getErrors();
```

### Get ErrorMessage
```php
    ->getErrorMessage();
```
