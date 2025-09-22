<?php

namespace Tests\Feature\Custom\Rule;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use KentJerone\ChainRule\ChainRule;

class HasConditionTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_if_true(): void
    {
        $rule = chainRule()->addIfTrue(true, 'required');
        $this->assertEquals(['required'], $rule->toArray());

        $rule = chainRule()->addIfTrue(false, 'required');
        $this->assertEquals([], $rule->toArray());
    }

    public function test_add_if_false(): void
    {
        $rule = chainRule()->string()->addIfFalse(false, 'required');
        $this->assertEquals(['string', 'required'], $rule->toArray());

        $rule = chainRule()->string()->addIfFalse(true, 'required');
        $this->assertEquals(['string'], $rule->toArray());
    }

    public function test_add_if_empty(): void
    {
        $values = [
            [], '', (object) [], null, 0, 0.0, false
        ];

        foreach ($values as $value) {
            // Test adding with string
            $rule = chainRule()->string()->addIfEmpty($value, 'required');
            $this->assertEquals(['string', 'required'], $rule->toArray());

            // Test adding with array
            $rule = chainRule()->string()->addIfEmpty($value, ['required']);
            $this->assertEquals(['string', 'required'], $rule->toArray());

            // Test adding with ChainRule
            $rule = chainRule()->string()->addIfEmpty($value, chainRule()->required());
            $this->assertEquals(['string', 'required'], $rule->toArray());
        }
    }

    public function test_add_if_not_empty(): void
    {
        $values = [
            [], '', (object) [], null, 0, 0.0, false
        ];

        foreach ($values as $value) {
            // Test adding with string
            $rule = chainRule()->string()->addIfNotEmpty($value, 'required');
            $this->assertEquals(['string'], $rule->toArray());

            // Test adding with array
            $rule = chainRule()->string()->addIfNotEmpty($value, ['required']);
            $this->assertEquals(['string'], $rule->toArray());

            // Test adding with ChainRule
            $rule = chainRule()->string()->addIfNotEmpty($value, chainRule()->required());
            $this->assertEquals(['string'], $rule->toArray());
        }

        // Positive case (non-empty values)
        $nonEmptyValues = [
            ['foo'], 'hello', 1, 1.5, true
        ];

        foreach ($nonEmptyValues as $value) {
            $rule = chainRule()->string()->addIfNotEmpty($value, 'required');
            $this->assertEquals(['string', 'required'], $rule->toArray());
        }
    }

    public function test_deduplication(): void
    {
        $rule = chainRule()->required()->merge(['required', 'string'])->merge(['string', 'max:255']);
        $this->assertEquals(['required', 'string', 'max:255'], $rule->toArray());
    }


     public function test_add_when_callback_returns_true(): void
    {
        // Using string argument
        $rule = chainRule()->addWhen(fn() => true, 'required');
        $this->assertEquals(['required'], $rule->toArray());

        // Using array argument
        $rule = chainRule()->string()->addWhen(fn() => true, ['required', 'max:255']);
        $this->assertEquals(['string', 'required', 'max:255'], $rule->toArray());

        // Using ChainRule argument
        $rule = chainRule()->string()->addWhen(fn() => true, chainRule()->required()->max(255));
        $this->assertEquals(['string', 'required', 'max:255'], $rule->toArray());
    }

    public function test_add_when_callback_returns_false(): void
    {
        // Using string argument
        $rule = chainRule()->addWhen(fn() => false, 'required');
        $this->assertEquals([], $rule->toArray());

        // Using array argument
        $rule = chainRule()->string()->addWhen(fn() => false, ['required', 'max:255']);
        $this->assertEquals(['string'], $rule->toArray());

        // Using ChainRule argument
        $rule = chainRule()->string()->addWhen(fn() => false, chainRule()->required()->max(255));
        $this->assertEquals(['string'], $rule->toArray());
    }

    public function test_add_when_with_dynamic_values(): void
    {
        $age = 20;

        $rule = chainRule()->addWhen(fn() => $age >= 18, 'required');
        $this->assertEquals(['required'], $rule->toArray());

        $rule = chainRule()->addWhen(fn() => $age < 18, 'required');
        $this->assertEquals([], $rule->toArray());
    }

}
