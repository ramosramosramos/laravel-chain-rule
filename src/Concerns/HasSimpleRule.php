<?php

declare(strict_types=1);

namespace KentJerone\ChainRule\Concerns;

trait HasSimpleRule
{
    use HasAddRule;

    /**
     * @link https://laravel.com/docs/12.x/validation#rule-ascii
     */
    public function ascii(): self
    {
        return $this->addRule('ascii');
    }

    /**
     * @link https://laravel.com/docs/12.x/validation#rule-accepted
     */
    public function accepted(): self
    {
        return $this->addRule('accepted');
    }

    /**
     * @link https://laravel.com/docs/12.x/validation#rule-active-url
     */
    public function activeUrl(): self
    {

        return $this->addRule('active_url');
    }

    /**
     * @link https://laravel.com/docs/12.x/validation#rule-alpha
     */
    public function alpha(): self
    {

        return $this->addRule('alpha');
    }

        public function alphaSpace(): self
    {

        return $this->addRule('regex:/^[\pL\s]+$/u');
    }

    public function alphaDash(): self
    {

        return $this->addRule('alpha_dash');
    }

    public function array(): self
    {

        return $this->addRule('array');
    }

    public function bail(): self
    {

        return $this->addRule('bail');
    }

    public function boolean(): self
    {

        return $this->addRule('boolean');
    }

    public function confirmed(): self
    {

        return $this->addRule('confirmed');
    }

    public function date(): self
    {

        return $this->addRule('date');
    }

    public function declined(): self
    {

        return $this->addRule('declined');
    }

    public function file(): self
    {
        return $this->addRule('file');
    }

    public function filled(): self
    {
        return $this->addRule('filled');
    }

    public function get(): self
    {

        return $this->addRule('get');
    }

    public function image(): self
    {
        return $this->addRule('image');
    }

    public function inspect(): self
    {
        return $this->addRule('inspect');
    }

    public function integer(): self
    {
        return $this->addRule('integer');
    }

    /**
     *@link https://laravel.com/docs/12.x/validation#rule-integer
     */
    public function integerStrict(): self
    {
        return $this->addRule('integer:strict');
    }

    public function ip(): self
    {
        return $this->addRule('ip');
    }

    public function ipv4(): self
    {
        return $this->addRule('ipv4');
    }

    public function ipv6(): self
    {
        return $this->addRule('ipv6');
    }

    public function json(): self
    {
        return $this->addRule('json');
    }

    public function lowercase(): self
    {
        return $this->addRule('lowercase');
    }

    public function macAddress(): self
    {
        return $this->addRule('mac_address');
    }

    public function nullable(): self
    {
        return $this->addRule('nullable');
    }

    public function numeric(): self
    {

        return $this->addRule('numeric');
    }

    public function required(): self
    {

        return $this->addRule('required');
    }

    public function regexYearRange(): self
    {

        return $this->addRule('regex:/^\d{4}-\d{4}$/');
    }

    /**
     * It will add a string
     */
    public function string(): self
    {

        return $this->addRule('string');
    }

    public function sometimes(): self
    {

        return $this->addRule('sometimes');
    }

    public function uppercase(): self
    {

        return $this->addRule('uppercase');
    }

    public function present(): self
    {

        return $this->addRule('present');
    }

    public function password(): self
    {

        return $this->addRule('password');
    }

    public function prohibited(): self
    {

        return $this->addRule('prohibited');
    }

    public function update(): self
    {

        return $this->addRule('update');
    }

    public function uuid(): self
    {

        return $this->addRule('uuid');
    }

    // /
    public function currentYear(): self
    {

        return $this->addRule('max:'.(date('Y') + 1));
    }
}
