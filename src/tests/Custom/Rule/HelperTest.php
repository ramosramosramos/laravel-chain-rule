<?php

namespace Tests\Feature\Custom\Rule;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class HelperTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function setUp(): void
    {
        parent::setUp();

    }
    public function test_chain_rule_helper(): void
    {

        $this->assertTrue(function_exists('chainRule'), 'chainRule() helper is not loaded');
        $rule = chainRule()->required()->string();
        $this->assertIsObject($rule);
        $this->assertIsArray($rule->toArray());
        $this->assertIsString($rule->toString());
    }
}
