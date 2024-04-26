<?php

declare(strict_types=1);

return [
    'main_subscription_tag' => 'main',
    'fallback_plan_tag' => null,
    // Database Tables
    'tables' => [
        'plans' => 'plans',
        'plan_combinations' => 'plan_combinations',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_features' => 'plan_subscription_features',
        'plan_subscription_schedules' => 'plan_subscription_schedules',
        'plan_subscription_usage' => 'plan_subscription_usage',
    ],

    // Models
    'models' => [
        'plan' => Ljsharp\LaraSub\Models\Plan::class,
        'plan_combination' => Ljsharp\LaraSub\Models\PlanCombination::class,
        'plan_feature' => Ljsharp\LaraSub\Models\PlanFeature::class,
        'plan_subscription' => Ljsharp\LaraSub\Models\PlanSubscription::class,
        'plan_subscription_feature' => Ljsharp\LaraSub\Models\PlanSubscriptionFeature::class,
        'plan_subscription_schedule' => Ljsharp\LaraSub\Models\PlanSubscriptionSchedule::class,
        'plan_subscription_usage' => Ljsharp\LaraSub\Models\PlanSubscriptionUsage::class,
    ],

    'services' => [
        'payment_methods' => [
            'free' => Ljsharp\LaraSub\Services\PaymentMethods\Free::class,
        ],
    ],
];
