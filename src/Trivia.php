<?php

namespace PragmaRX\Random;

use PragmaRX\Random\Generators\ArrayGenerator;
use PragmaRX\Trivia\Trivia as TriviaService;

trait Trivia
{
    use ArrayGenerator;

    /**
     * Generate trivia lines.
     *
     * @return static
     */
    public function trivia()
    {
        $this->array = true;

        $this->count = 1;

        $this->items = (new TriviaService())->all();

        return $this;
    }
}
