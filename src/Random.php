<?php

namespace PragmaRX\Random;

use PragmaRX\Random\Generators\AlphaGenerator;
use PragmaRX\Random\Generators\ArrayGenerator;
use PragmaRX\Random\Generators\IntegerGenerator;
use PragmaRX\Random\Generators\StringGenerator;

class Random
{
    use CharCase,
        Faker,
        Trivia,
        AlphaGenerator,
        StringGenerator,
        IntegerGenerator;

    const DEFAULT_STRING_SIZE = 16;

    const DEFAULT_PATTERN = '[A-Za-z0-9]';

    protected $numeric = false;

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
     * Generate a random string.
     *
     * @return string|array
     */
    protected function generate()
    {
        if (! is_null($this->fakerString)) {
            return $this->fakerString;
        }

        if ($this->array) {
            return $this->generateArray();
        }

        return $this->numeric
            ? $this->generateNumeric()
            : $this->generateAlpha();
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
     * Get string pattern.
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Configure to get a raw.
     *
     * @return string
     */
    public function raw()
    {
        $this->pattern = null;

        return $this;
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
