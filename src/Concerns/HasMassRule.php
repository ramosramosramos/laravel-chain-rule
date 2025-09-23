<?php

namespace KentJerone\ChainRule\Concerns;

use KentJerone\ChainRule\ChainRule;

trait HasMassRule
{
    /**
     * @var string[]
     */
    protected array $rules = [];

    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function mass(bool $condition, array|string|self|ChainRule $arguments): self
    {
        if ($condition === true) {
            $this->addRule($arguments);

            return $this;
        }

        return $this;
    }
}
