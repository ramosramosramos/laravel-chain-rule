<?php

namespace KentJerone\ChainRule\Concerns;

use KentJerone\ChainRule\ChainRule;

trait HasAddRule
{
    /**
     * @var array<int, string|\Illuminate\Contracts\Validation\Rule|\Closure>
     */
    protected array $rules = [];

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    protected function addRule(array|string|self|ChainRule $arguments): self
    {
        if (is_string($arguments)) {
            $this->rules[] = $arguments;
        } elseif (is_array($arguments)) {
            $this->rules = array_merge($this->rules, $arguments);
        } elseif ($arguments instanceof ChainRule || $arguments instanceof self) {
            $this->rules = array_merge($this->rules, $arguments->toArray());
        }

        // Remove duplicates
        $this->rules = array_values(array_unique($this->rules));

        return $this;
    }
}
