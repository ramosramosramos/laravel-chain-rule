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
        $rule1 = chainRule()->required()->string();
        $rule2 = cr()->required()->string();
        $this->assertIsObject($rule1);
        $this->assertIsArray($rule1->toArray());
        $this->assertIsString($rule1->toString());

          $this->assertIsObject($rule2);
        $this->assertIsArray($rule2->toArray());
        $this->assertIsString($rule2->toString());
    }
}
