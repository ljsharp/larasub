<?php

namespace Ljsharp\LaraSub\Tests\Unit;

use Ljsharp\LaraSub\Models\Plan;
use Ljsharp\LaraSub\Tests\TestCase;

class PlanTest extends TestCase
{
    /**
     * Test Plan creation with already existing tag in database.
     */
    public function testUnableToCreatePlanWithExistingTag()
    {
        $this->expectException('Ljsharp\LaraSub\Exceptions\DuplicateException');
        Plan::create([
            'tag' => 'basic',
            'name' => 'New Basic Plan',
            'description' => 'This plan cannot exist.',
            'currency' => 'EUR',
        ]);
    }
}
