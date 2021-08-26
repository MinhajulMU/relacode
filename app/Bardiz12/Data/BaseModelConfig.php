<?php

namespace App\Bardiz12\Data;


class BaseModelConfig{

    public function __construct(String $keyword, Array $field, Array $exclude)
    {
        $this->keyword = $keyword;
        $this->field = $field;
        $this->exclude = $exclude;
    }
}

