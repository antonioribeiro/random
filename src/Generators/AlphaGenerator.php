<?php

namespace PragmaRX\Random\Generators;

trait AlphaGenerator
{
    /**
     * Generate a random string.
     *
     * @return int|string
     */
    protected function generateAlpha()
    {
        return $this->generateString($this->getAlphaGenerator());
    }

    /**
     * Get the alpha generator.
     *
     * @return mixed
     */
    protected function getNumericGenerator()
    {
        return function () {
            return random_int(0, PHP_INT_MAX);
        };
    }

    /**
     * Generate a numeric random value.
     *
     * @return int|string
     */
    protected function generateNumeric()
    {
        if (is_null($this->size) && $this->pattern == static::DEFAULT_PATTERN) {
            return $this->generateInteger();
        }

        return $this->generateString($this->getNumericGenerator());
    }
}
