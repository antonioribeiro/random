<?php

namespace PragmaRX\Random;

class Random
{
    use CharCase;
    
    const DEFAULT_STRING_SIZE = 16;

    const DEFAULT_PATTERN = '[A-Za-z0-9]';

    protected $numeric = false;

    protected $start = 0;

    protected $end = PHP_INT_MAX;

    protected $size = null;

    protected $pattern = '[A-Za-z0-9]';

    /**
     * Extract a string pattern from a string.
     *
     * @param $string
     * @return string
     */
    protected function extractPattern($string)
    {
        if (is_null($pattern = $this->getPattern())) {
            return $string;
        }

        preg_match_all("/$pattern/", $string, $matches);

        return implode('', $matches[0]);
    }

    /**
     * Generate a random string.
     *
     * @return string
     */
    protected function generate()
    {
        return $this->numeric
            ? $this->generateNumeric()
            : $this->generateAlpha();
    }

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

    /**
     * Get numeric end.
     *
     * @return int
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get string pattern.
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Get string pattern.
     *
     * @return string
     */
    public function noPattern()
    {
        $this->pattern = null;

        return $this;
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
     * Get numeric start.
     *
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Generate a random hex.
     *
     * @return string
     */
    public function hex()
    {
        $this->pattern('[a-f0-9]')->uppercase();

        return $this;
    }

    /**
     * Set string pattern.
     *
     * @param string $pattern
     * @return $this
     */
    public function pattern($pattern)
    {
        $this->pattern = $pattern;

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

    /**
     * Set result to numeric.
     *
     * @param bool $state
     * @return $this
     */
    public function numeric($state = true)
    {
        $this->numeric = $state;

        return $this;
    }

    /**
     * Set result to alpha.
     *
     * @param bool $state
     * @return $this
     */
    public function alpha($state = true)
    {
        $this->numeric = !$state;

        return $this;
    }

    /**
     * Set numeric end.
     *
     * @param int $end
     * @return $this
     */
    public function end($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Set numeric start.
     *
     * @param int $start
     * @return $this
     */
    public function start($start)
    {
        $this->start = $start;

        return $this;
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
     * Generate a more truly "random" alpha-numeric string.
     *
     * Extracted from Laravel Framework: Illuminate\Support\Str
     *
     * @return string|int
     */
    public function get()
    {
        return $this->changeCase(
            $this->generate()
        );
    }
}
