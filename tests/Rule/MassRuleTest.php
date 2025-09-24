<?php

namespace Tests\Feature\Custom\Rule;

use Illuminate\Validation\Rule;
use Orchestra\Testbench\TestCase;

class MassRuleTest extends TestCase
{

    public function test_mass_output_nullable_string_min_max()
    {
        $this->assertEquals(
            chainRule()->nullable_string_min_max()->toArray(),
            ['nullable', 'string', 'min:0', 'max:255']
        );
        $this->assertEquals(
            chainRule()->nullable_string_min_max(5)->toArray(),
            ['nullable', 'string', 'min:5', 'max:255']
        );
        $this->assertEquals(
            chainRule()->nullable_string_min_max(5, 10)->toArray(),
            ['nullable', 'string', 'min:5', 'max:10']
        );

    }

    public function test_mass_output_required_string_min_max()
    {
        $this->assertEquals(
            chainRule()->required_string_min_max()->toArray(),
            ['required', 'string', 'min:0', 'max:255']
        );
        $this->assertEquals(
            chainRule()->required_string_min_max(5)->toArray(),
            ['required', 'string', 'min:5', 'max:255']
        );
        $this->assertEquals(
            chainRule()->required_string_min_max(5, 10)->toArray(),
            ['required', 'string', 'min:5', 'max:10']
        );
    }

    public function test_mass_output_nullable_string()
    {
        $this->assertEquals(
            chainRule()->nullable_string()->toArray(),
            ['nullable', 'string']
        );

    }
    public function test_mass_output_required_string()
    {
        $this->assertEquals(
            chainRule()->required_string()->toArray(),
            ['required', 'string']
        );

    }

    public function test_mass_output_nullable_integer()
    {
        $this->assertEquals(
            chainRule()->nullable_integer()->toArray(),
            ['nullable', 'integer']
        );

    }
    public function test_mass_output_required_integer()
    {
        $this->assertEquals(
            chainRule()->required_integer()->toArray(),
            ['required', 'integer']
        );

    }

    public function test_mass_output_nullable_alphabet_and_numeric()
    {
        $this->assertEquals(
            chainRule()->nullable_alphabet_and_numeric()->toArray(),
            ['nullable', 'alpha_num']
        );
    }
    public function test_mass_output_required_alphabet_and_numeric()
    {
        $this->assertEquals(
            chainRule()->required_alphabet_and_numeric()->toArray(),
            ['required', 'alpha_num']
        );
    }


    public function test_mass_output_nullable_boolean()
    {
        $this->assertEquals(
            chainRule()->nullable_boolean()->toArray(),
            ['nullable', 'boolean']
        );
    }
    public function test_mass_output_required_boolean()
    {
        $this->assertEquals(
            chainRule()->required_boolean()->toArray(),
            ['required', 'boolean']
        );
    }


    public function test_mass_output_nullable_date()
    {
        $this->assertEquals(
            chainRule()->nullable_date()->toArray(),
            ['nullable', 'date']
        );
    }
    public function test_mass_output_required_date()
    {
        $this->assertEquals(
            chainRule()->required_date()->toArray(),
            ['required', 'date']
        );
    }

}
