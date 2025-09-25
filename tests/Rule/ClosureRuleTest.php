<?php

namespace Tests\Feature\Custom\Rule;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use KentJerone\ChainRule\ChainRule;
use Orchestra\Testbench\TestCase;
class ClosureRuleTest extends TestCase
{

    public function test_it_returns_unique_array_rules()
    {
        $rule = ChainRule::make()
            ->merge(['required', 'required', 'email'])
            ->merge([Rule::unique('users', 'email'), Rule::unique('users', 'email')]);

        $rules = $rule->toArray();

        // Should not contain duplicates
        $this->assertCount(3, $rules);
        $this->assertContains('required', $rules);
        $this->assertContains('email', $rules);
        $this->assertTrue(
            collect($rules)->contains(fn($r) => $r instanceof \Illuminate\Validation\Rules\Unique)
        );
    }


    public function test_it_converts_to_string_only_for_string_rules()
    {
        $rule = ChainRule::make()->merge(['required', 'email', 'string']);
        $stringRules = $rule->toString();

        $this->assertSame('required|email|string', $stringRules);
    }


    public function test_it_throws_when_to_string_contains_non_string_rules()
    {
        $this->expectException(\LogicException::class);

        ChainRule::make()
            ->merge(['required', Rule::unique('users')])
            ->toString();
    }


    public function test_it_works_with_validator()
    {
        $rules = ChainRule::make()
            ->merge(['required', 'email'])
            ->merge([Rule::unique('users', 'email')])
            ->toArray();

        $data = ['email' => 'not-an-email'];

        $validator = Validator::make(['email' => 'not-an-email'], [
            'email' => $rules,
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
    }


    public function closure_rules_are_deduplicated()
    {
        $closure = function ($attribute, $value, $fail) {
            if ($value !== 'ok') {
                $fail('Invalid value.');
            }
        };

        $rule = ChainRule::make()
            ->merge([$closure, $closure, 'required']);

        $rules = $rule->toArray();

        // should contain only one closure + required
        $this->assertCount(2, $rules);
        $this->assertTrue(
            collect($rules)->contains(fn($r) => is_callable($r))
        );
    }
}
