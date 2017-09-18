<?php

namespace PragmaRX\Random;

class Random
{
    const STRING_DEFAULT_SIZE = 16;

    protected $lowercase = false;

    protected $uppercase = false;

    protected $numeric = false;

    protected $start = 0;

    protected $end = PHP_INT_MAX;

    protected $size = null;

    protected $pattern = null;

    /**
     * Extract a string pattern from a string.
     *
     * @param $string
     * @return string
     */
    private function extractPattern($string)
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

    private function generateInteger()
    {
        return random_int($this->getStart(), $this->getEnd());
    }

    /**
     * Generate a random string.
     *
     * @param \Closure $generator
     * @return mixed
     */
    private function generateString($generator)
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
    private function getAlphaGenerator()
    {
        return function ($size) {
            return str_replace(['/', '+', '='], '', base64_encode(random_bytes($size)));
        };
    }

    /**
     * Get the alpha generator.
     *
     * @return mixed
     */
    private function getNumericGenerator()
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
    private function generateAlpha()
    {
        return $this->generateString($this->getAlphaGenerator());
    }

    /**
     * Generate a numeric random value.
     *
     * @return int|string
     */
    private function generateNumeric()
    {
        if (is_null($this->size) && is_null($this->pattern)) {
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
     * Get the final string size.
     *
     * @return null
     */
    public function getSize()
    {
        return $this->size;
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
     * Get lowercase state.
     *
     * @return bool
     */
    public function isLowercase()
    {
        return $this->lowercase;
    }

    /**
     * Get uppercase state.
     *
     * @return bool
     */
    public function isUppercase()
    {
        return $this->uppercase;
    }

    /**
     * Return a string in the proper case.
     *
     * @param $string
     * @return string
     */
    private function changeCase($string)
    {
        if ($this->isLowercase()) {
            return strtolower($string);
        }

        if ($this->isUppercase()) {
            return strtoupper($string);
        }

        return $string;
    }

    /**
     * Set the lowercase state.
     *
     * @param $state
     * @return $this
     */
    public function lowercase($state = true)
    {
        $this->mixedcase()->lowercase = $state;

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
    private function trimToExpectedSize($string, $size = null)
    {
        return substr($string, 0, $size ?: $this->getSize());
    }

    /**
     * Set case to mixed.
     *
     * @return $this
     */
    public function mixedcase()
    {
        $this->uppercase = false;

        $this->lowercase = false;

        return $this;
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
     * Set the uppercase state.
     *
     * @param $state
     * @return $this
     * @internal param bool $uppercase
     */
    public function uppercase($state = true)
    {
        $this->mixedcase()->uppercase = $state;

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
