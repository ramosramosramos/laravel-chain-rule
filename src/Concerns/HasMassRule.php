<?php

namespace KentJerone\ChainRule\Concerns;

trait HasMassRule
{
    /**
     * Default output nullable, string, min = 0, max = 255
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function nullable_string_min_max(int $min = 0, int $max = 255): self
    {
        return chainRule()->nullable()->string()->min($min)->max($max);
    }

    /**
     * Default output required, string, min = 0, max = 255
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function required_string_min_max(int $min = 0, int $max = 255): self
    {
        return chainRule()->required()->string()->min($min)->max($max);
    }

    /**
     * Default output nullable, string,
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function nullable_string(): self
    {
        return chainRule()->nullable()->string();
    }

    /**
     * Default output required, string
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function required_string(): self
    {
        return chainRule()->required()->string();
    }

    /**
     * Default output nullable, integer
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function nullable_integer(): self
    {
        return chainRule()->nullable()->integer();
    }

    /**
     * Default output required, integer
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function required_integer(): self
    {
        return chainRule()->required()->integer();
    }

    /**
     * Default output nullable, numeric
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function nullable_numeric(): self
    {
        return chainRule()->nullable()->numeric();
    }

    /**
     * Default output required, numeric
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function required_numeric(): self
    {
        return chainRule()->required()->numeric();
    }

    /**
     * Default output nullable, alpha_num (alphabet or numeric)
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function nullable_alphabet_and_numeric(): self
    {
        return chainRule()->nullable()->alphabetAndNumeric();
    }

    /**
     * Default output required, alpha_num (alphabet or numeric)
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function required_alphabet_and_numeric(): self
    {
        return chainRule()->required()->alphabetAndNumeric();
    }

    /**
     * Default output nullable, boolean
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function nullable_boolean(): self
    {
        return chainRule()->nullable()->boolean();
    }

    /**
     * Default output required, boolean
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function required_boolean(): self
    {
        return chainRule()->required()->boolean();
    }

    /**
     * Default output nullable, date
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function nullable_date(): self
    {
        return chainRule()->nullable()->date();
    }

    /**
     * Default output required, date
     *
     * @return \KentJerone\ChainRule\ChainRule
     */
    public function required_date(): self
    {
        return chainRule()->required()->date();
    }
}
