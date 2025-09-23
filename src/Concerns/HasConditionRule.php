<?php

namespace KentJerone\ChainRule\Concerns;

use KentJerone\ChainRule\ChainRule;

trait HasConditionRule
{
    use HasAddRule;


    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $argumentRules
     */
    public function addIfTrue(bool $condition, array|string|self|ChainRule $argumentRules): self
    {
        if ($condition === true) {
            return $this->addRule($argumentRules);

        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $argumentRules
     */
    public function addIfFalse(bool $condition, array|string|self|ChainRule $argumentRules): self
    {
        if ($condition === false) {
            return $this->addRule($argumentRules);

        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $argumentRules
     */
    public function addIfEmpty(mixed $condition, array|string|self|ChainRule $argumentRules): self
    {
        $isEmpty = empty($condition) || (is_object($condition) && count(get_object_vars($condition)) === 0);

        if ($isEmpty) {
            return $this->addRule($argumentRules);
        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $argumentRules
     */
    public function addIfNotEmpty(mixed $condition, array|string|self|ChainRule $argumentRules): self
    {
        $isNotEmpty = ! empty($condition) && ! (is_object($condition) && count(get_object_vars($condition)) === 0);

        if ($isNotEmpty) {
            return $this->addRule($argumentRules);
        }

        return $this;
    }

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $argumentRules
     */
    public function addWhen(callable $callback, array|string|self|ChainRule $argumentRules): self
    {
        if ($callback()) {   // if callback returns true
            return $this->addRule($argumentRules); // rule is added
        }

        return $this;
    }
}
