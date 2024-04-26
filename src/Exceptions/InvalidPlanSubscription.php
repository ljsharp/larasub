<?php

namespace Ljsharp\LaraSub\Exceptions;

class InvalidPlanSubscription extends LaravelLaraSubException
{
    public function __construct($subscriptionTag = '')
    {
        $message = "Subscription '{$subscriptionTag}' not found.";

        parent::__construct($message);
    }
}
