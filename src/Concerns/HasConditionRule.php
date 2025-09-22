<?php
namespace KentJerone\ChainRule\Concerns;

use KentJerone\ChainRule\ChainRule;

trait HasConditionRule
{

    /**
     * @var string[]
     */
    protected array $rules = [];

    /**
     * @param bool $condition
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
     * @param bool $condition
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
     * @param mixed $condition
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
     * @param mixed $condition
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function addIfNotEmpty(mixed $condition, array|string|self|ChainRule $arguments): self
    {
        $isNotEmpty = !empty($condition) && !(is_object($condition) && count(get_object_vars($condition)) === 0);

        if ($isNotEmpty) {
            $this->addRule($arguments);
        }

        return $this;
    }

    /**
     * @param callable $callback
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     */
    public function addWhen(callable $callback, array|string|self|ChainRule $arguments): self
    {
        if ($callback()) {   // if callback returns true
            $this->addRule($arguments); // rule is added
        }
        return $this;
    }




    /**
     * @param array|string||\KentJerone\ChainRule\ChainRule $arguments
     * @return void
     */
    protected function addRule(array|string|self|ChainRule $arguments): void
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
    }


}
