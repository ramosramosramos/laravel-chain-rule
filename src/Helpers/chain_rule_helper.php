<?php

declare(strict_types=1);

use KentJerone\ChainRule\ChainRule;

/**
 * Create a new ChainRule instance.
 *
 * @return \KentJerone\ChainRule\ChainRule
 */
if (! function_exists('chainRule')) {
    function chainRule(): ChainRule
    {
        return ChainRule::make();
    }
}
/**
 * Create a new ChainRule instance.
 *
 * @return \KentJerone\ChainRule\ChainRule
 */
if (! function_exists('cr')) {
    function cr(): ChainRule
    {
        return ChainRule::make();
    }
}
