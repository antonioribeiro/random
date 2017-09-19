<?php

namespace PragmaRX\Random;

trait CharCase
{
    protected $lowercase = false;

    protected $uppercase = false;

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
    protected function changeCase($string)
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
}
