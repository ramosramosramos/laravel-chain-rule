<?php

namespace KentJerone\ChainRule\Concerns;

use KentJerone\ChainRule\ChainRule;

trait HasConditionRule
{
    use HasAddRule;

    /**
     * @var string[]
     */
    protected array $rules = [];

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function addIfTrue(bool $condition, array|string|self|ChainRule $arguments): self
    {
        if ($condition === true) {
            $this->addRule($arguments);

            return $this;
        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function addIfFalse(bool $condition, array|string|self|ChainRule $arguments): self
    {
        if ($condition === false) {
            $this->addRule($arguments);

            return $this;
        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function addIfEmpty(mixed $condition, array|string|self|ChainRule $arguments): self
    {
        $isEmpty = empty($condition) || (is_object($condition) && count(get_object_vars($condition)) === 0);

        if ($isEmpty) {
            $this->addRule($arguments);
        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function addIfNotEmpty(mixed $condition, array|string|self|ChainRule $arguments): self
    {
        $isNotEmpty = ! empty($condition) && ! (is_object($condition) && count(get_object_vars($condition)) === 0);

        if ($isNotEmpty) {
            $this->addRule($arguments);
        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function addWhen(callable $callback, array|string|self|ChainRule $arguments): self
    {
        if ($callback()) {   // if callback returns true
            $this->addRule($arguments); // rule is added
        }

        return $this;
    }
}
