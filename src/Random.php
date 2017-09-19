<?php

namespace PragmaRX\Random;

class Random
{
    use Generators, CharCase, Faker;

    const DEFAULT_STRING_SIZE = 16;

    const DEFAULT_PATTERN = '[A-Za-z0-9]';

    protected $numeric = false;

    protected $start = 0;

    protected $end = PHP_INT_MAX;

    protected $size = null;

    protected $pattern = '[A-Za-z0-9]';

    private $prefix;

    private $suffix;

    /**
     * Get a prefixed and/or suffixed string.
     *
     * @param $value
     * @return string
     */
    private function addPrefixSuffix($value)
    {
        if (!is_null($this->prefix) || !is_null($this->suffix)) {
            return (string) $this->prefix . $value . (string) $this->suffix;
        }

        return $value;
    }

    /**
     * Set the string suffix.
     *
     * @param $string
     * @return $this
     */
    public function suffix($string)
    {
        $this->suffix = $string;

        return $this;
    }

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
     * Set the string prefix.
     *
     * @param $string
     * @return $this
     */
    public function prefix($string)
    {
        $this->prefix = $string;

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
     * Reset one-time values.
     *
     * @return $this
     */
    public function resetOneTimeValues()
    {
        $this->prefix = null;

        $this->suffix = null;

        $this->fakerString = null;

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
     * Get the generated random string/number.
     *
     * @return string|int
     */
    public function get()
    {
        $result = $this->addPrefixSuffix(
            $this->changeCase(
                $this->generate()
            )
        );

        $this->resetOneTimeValues();

        return $result;
    }
}
