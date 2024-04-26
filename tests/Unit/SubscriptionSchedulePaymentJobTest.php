<?php

namespace Ljsharp\LaraSub\Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ljsharp\LaraSub\Jobs\SubscriptionSchedulePaymentJob;
use Ljsharp\LaraSub\Services\PendingPaymentCollector;
use Ljsharp\LaraSub\Tests\TestCase;

class SubscriptionSchedulePaymentJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a successful payment schedule.
     * @throws \Exception
     */
    public function testSuccessfulJob()
    {
        $date = Carbon::now()->add(10, 'day');
        $subscription = $this->testUser->subscription('main');
        $subscription->payment_method = 'success';
        $subscription->save();

        $subscription->toPlan($this->testPlanPro)->onDate($date)->setSchedule();

        $this->travelTo($date->add(5, 'second'));

        $pendingPaymentCollector = new PendingPaymentCollector();
        $pendingPayments = $pendingPaymentCollector->collectScheduledPayments();

        $job = (new SubscriptionSchedulePaymentJob($pendingPayments[0]['collectable_id']));
        dispatch_sync($job);

        $planSubscriptionSchedule = app(config('subby.models.plan_subscription_schedule'))::find($pendingPayments[0]['collectable_id']);

        $this->assertNull($planSubscriptionSchedule->failed_at);
        $this->assertNotNull($planSubscriptionSchedule->succeeded_at);
        $this->assertTrue($this->testUser->isSubscribedTo($this->testPlanPro->id));
    }

    /**
     * Test a failed payment schedule.
     * @throws \Exception
     */
    public function testFailedJob()
    {
        $date = Carbon::now()->add(10, 'day');
        $subscription = $this->testUser->subscription('main');
        $subscription->payment_method = 'fail';
        $subscription->save();

        $subscription->toPlan($this->testPlanPro)->onDate($date)->setSchedule();

        $this->travelTo($date->add(5, 'second'));

        $pendingPaymentCollector = new PendingPaymentCollector();
        $pendingPayments = $pendingPaymentCollector->collectScheduledPayments();

        $job = (new SubscriptionSchedulePaymentJob($pendingPayments[0]['collectable_id']));
        $this->expectException('\Exception');
        dispatch_sync($job);

        $planSubscriptionSchedule = app(config('subby.models.plan_subscription_schedule'))::find($pendingPayments[0]['collectable_id']);

        $this->assertNotNull($planSubscriptionSchedule->failed_at);
        $this->assertNull($planSubscriptionSchedule->succeeded_at);
        $this->assertFalse($this->testUser->isSubscribedTo($this->testPlanPro->id));
    }
}
