<?php

declare(strict_types=1);

namespace KentJerone\ChainRule;

use KentJerone\ChainRule\Concerns\HasSimpleRule;
use KentJerone\ChainRule\Concerns\HasConditionRule;
use KentJerone\ChainRule\Concerns\HasParameterRule;

class ChainRule
{
    use HasParameterRule;
    use HasSimpleRule;
    use HasConditionRule;

    /**
     * @var string[]
     */
    protected array $rules = [];

    public static function make(): self
    {
        return new self();
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return  array_values(array_unique($this->rules));
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return implode('|',  array_values(array_unique($this->rules)));
    }

    /**
     * @param  string[]  $rule
     * @return ChainRule
     */
    public function merge(array $rule): self
    {
        $this->rules = array_merge($this->rules, $rule);
        $this->rules = array_values(array_unique($this->rules)); // remove duplicates

        return $this;
    }



}
