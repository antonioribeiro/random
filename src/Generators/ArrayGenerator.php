<?php

namespace PragmaRX\Random\Generators;

trait ArrayGenerator
{
    protected $array = false;

    protected $items = [];

    protected $count = 1;

    /**
     * Set the array items count.
     *
     * @param $count
     * @return $this
     */
    public function count($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Generate random array elements.
     *
     * @return array
     */
    protected function generateArray()
    {
        $result = [];

        $last = count($this->items)-1;

        for ($counter = 1; $counter <= $this->count; $counter++) {
            $result[] = $this->items[$this->generateRandomInt(0, $last)];
        }

        if ($this->count == 1) {
            return $result[0];
        }

        return $result;
    }

    /**
     * Generate a random integer.
     *
     * @param int $start
     * @param int $end
     * @return int
     */
    abstract protected function generateRandomInt($start, $end);
}
