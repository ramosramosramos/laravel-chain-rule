<?php

declare(strict_types=1);

namespace KentJerone\ChainRule;

use Illuminate\Contracts\Support\Arrayable;
use KentJerone\ChainRule\Concerns\HasConditionRule;
use KentJerone\ChainRule\Concerns\HasMassRule;
use KentJerone\ChainRule\Concerns\HasParameterRule;
use KentJerone\ChainRule\Concerns\HasSimpleRule;

class ChainRule implements Arrayable
{
    use HasConditionRule;
    use HasMassRule;
    use HasParameterRule;
    use HasSimpleRule;

    /**
     * @var array<int, string|\Illuminate\Contracts\Validation\Rule|\Closure>
     */
    protected array $rules = [];

    public static function make(): self
    {
        return new self;
    }

    /**
     * @return array<int, mixed>
     */
    public function toArray(): array
    {
        return $this->uniqueRules($this->rules);
    }

    /**
     * @throws \LogicException if non-string rules are present
     */
    public function toString(): string
    {
        foreach ($this->rules as $rule) {
            if (! is_string($rule)) {
                throw new \LogicException(
                    'toString() can only be used when all rules are strings. '.
                    'Use toArray() for mixed rules (e.g., Rule objects or closures).'
                );
            }
        }

        return implode('|', array_values(array_unique($this->rules)));
    }

    /**
     * Merge new rules into the chain mixed param.
     *
     * @param  array<mixed,mixed>  $rules
     */
    public function merge(array $rules): self
    {
        $this->rules = $this->uniqueRules(array_merge($this->rules, $rules));

        return $this;
    }

    /**
     * @param array<int, string|\Illuminate\Contracts\Validation\Rule|\Closure>
     * @return array<int, string|\Illuminate\Contracts\Validation\Rule|\Closure>
     */
    protected function uniqueRules(array $rules): array
    {
        return collect($rules)
            ->unique(function ($item) {
                if (is_string($item)) {
                    return 'string:'.$item;
                }

                if ($item instanceof \Stringable) {
                    return 'stringable:'.(string) $item;
                }

                if (is_object($item)) {
                    return 'object:'.spl_object_id($item);
                }

                return 'other:'.md5(json_encode($item));
            })
            ->values()
            ->all();
    }
}
