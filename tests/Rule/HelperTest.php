<?php

namespace Tests\Feature\Custom\Rule;

use Orchestra\Testbench\TestCase;

class HelperTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
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
