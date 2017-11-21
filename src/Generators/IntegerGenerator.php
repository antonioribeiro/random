<?php

namespace PragmaRX\Random\Generators;

trait IntegerGenerator
{
    protected $start = 0;

    protected $end = PHP_INT_MAX;

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
     * Generate a random integer.
     *
     * @return int
     */
    protected function generateInteger()
    {
        return $this->generateRandomInt($this->getStart(), $this->getEnd());
    }

    /**
     * Generate a random integer.
     *
     * @param int $start
     * @param int $end
     * @return int
     */
    protected function generateRandomInt($start, $end)
    {
        return random_int($start, $end);
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
     * Get numeric start.
     *
     * @return int
     */
    public function getStart()
    {
        return $this->start;
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
}
