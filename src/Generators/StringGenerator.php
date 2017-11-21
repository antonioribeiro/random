<?php

namespace PragmaRX\Random\Generators;

trait StringGenerator
{
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
     * Get the final string size.
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size ?: static::DEFAULT_STRING_SIZE;
    }

    /**
     * Set the return string size.
     *
     * @param $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Trim string to expected size.
     *
     * @param $string
     * @param int|null $size
     * @return string
     */
    protected function trimToExpectedSize($string, $size = null)
    {
        return substr($string, 0, $size ?: $this->getSize());
    }
}
