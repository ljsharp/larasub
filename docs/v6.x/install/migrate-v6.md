# Upgrade v5.x to v6.x

## Composer

In your composer version, require `v6.0` version.

```json
"ljsharp/larasub": "^v6.0",
```

## Config

### New lines in config

Added `plan_combinations` under `tables` and models:

```php
    'tables' => [
        ...
        'plan_combinations' => 'plan_combinations',
        ...
    ],
    // Models
    'models' => [
        ...
        'plan_combinations' => \Ljsharp\LaraSub\Models\PlanCombination::class,
    ...
    ]
```

Added `payment_methods`, `'services'` now look should like this:

```php 
'services' => [
    'payment_methods' => [
        'free' => \Ljsharp\LaraSub\Services\PaymentMethods\Free::class
    ]
]
```

### Removed lines in config:

In `'services'`:

```php 
'services' => [
    'schedule' => [
        'default' => \Ljsharp\LaraSub\Services\ScheduleService::class
    ]
]
```

## Migrations

Publish v6 migrations

```shell
php artisan vendor:publish --tag=subby.migrations.v6.0.0
php artisan migrate
```

## Breaking changes

### Plan subscription schedule
* Method `usingService` is abandoned to use subscription's payment method.
* There are no longer multiple services to process the schedule. There is only one and it uses payments set via config. 
