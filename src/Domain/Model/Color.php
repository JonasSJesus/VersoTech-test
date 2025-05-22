<?php

namespace Jonas\Domain\Model;

class Color
{
    public readonly int $id;
    public readonly string $colorName;

    public function __construct(int $id, string $colorName)
    {
        $this->id = $id;
        $this->colorName = $colorName;
    }

}