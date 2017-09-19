<?php

namespace PragmaRX\Random;

trait Generators
{
    /**
     * Generate a random string.
     *
     * @return string
     */
    protected function generate()
    {
        if (! is_null($this->fakerString)) {
            return $this->fakerString;
        }

        return $this->numeric
            ? $this->generateNumeric()
            : $this->generateAlpha();
    }

    /**
     * Generate a ramdom integer.
     *
     * @return int
     */
    protected function generateInteger()
    {
        return random_int($this->getStart(), $this->getEnd());
    }

    /**
     * Generate a random string.
     *
     * @param \Closure $generator
     * @return mixed
     */
    protected function generateString($generator)
    {
        $string = '';

        while (strlen($string) < $size = $this->getSize()) {
            $string .= $this->extractPattern($generator($size));
        }

        return $this->trimToExpectedSize($string, $size);
    }

    /**
     * Get the alpha generator.
     *
     * @return mixed
     */
    protected function getAlphaGenerator()
    {
        return function ($size) {
            return random_bytes($size);
        };
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
     * Generate a random string.
     *
     * @return int|string
     */
    protected function generateAlpha()
    {
        return $this->generateString($this->getAlphaGenerator());
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
