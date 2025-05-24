<?php

namespace Jonas\Domain\Model;

class Color
{
    private ?int $id;
    public readonly ?string $colorName;

    public function __construct(string|null $colorName = null)
    {
        $this->colorName = $colorName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

}