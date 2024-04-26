<?php

declare(strict_types=1);

namespace Ljsharp\LaraSub\Tests\Services\PaymentMethods;

use Ljsharp\LaraSub\Contracts\PaymentMethodService;
use Ljsharp\LaraSub\Traits\IsPaymentMethod;

class FailedPaymentMethod implements PaymentMethodService
{
    use IsPaymentMethod;

    /**
     * Charge desired amount.
     * @return void
     */
    public function charge()
    {
        throw new \Exception('Payment failed');
    }
}
