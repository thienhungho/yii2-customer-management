Yii2 Customer Management System
====================
Customer Management System for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thienhungho/yii2-customer-management "*"
```

or add

```
"thienhungho/yii2-customer-management": "*"
```

to the require section of your `composer.json` file.

### Migration

Run the following command in Terminal for database migration:

```
yii migrate/up --migrationPath=@vendor/thienhungho/CustomerManagement/migrations
```

Or use the [namespaced migration](http://www.yiiframework.com/doc-2.0/guide-db-migrations.html#namespaced-migrations) (requires at least Yii 2.0.10):

```php
// Add namespace to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'thienhungho\CustomerManagement\migrations\namespaced',
        ],
    ],
],
```

Then run:
```
yii migrate/up
```

Config
------------

Add module CustomerManage to your `AppConfig` file.

```php
...
'modules'          => [
    ...
    /**
     * Block Manage
     */
    'customer-manage' => [
        'class' => 'thienhungho\CustomerManagement\modules\CustomerManage\CustomerManagerModule',
    ]
    ...
],
...
```

Modules
------------

[CustomerBase](https://github.com/thienhungho/yii2-customer-management/tree/master/src/modules/CustomerBase), [CustomerManage](https://github.com/thienhungho/yii2-customer-management/tree/master/src/modules/CustomerManage)

Functions
------------

[Core](https://github.com/thienhungho/yii2-customer-management/tree/master/src/functions/core.php)