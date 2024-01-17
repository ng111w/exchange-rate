<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\APIs\ExchangeRateAPI;
use App\Models\Base;
use App\Models\Rate;

class RelationShiponModelTest extends TestCase
{
    public function test_a_rate_has_an_owner(): void
    {
        $owner = Base::factory()->create();
        $rate = Rate::factory()->create([
            'base_id' => $owner->id
        ]);

        $this->assertInstanceOf(Base::class, $rate->base);
        $this->assertTrue($owner->is($rate->base));       
    }
}
