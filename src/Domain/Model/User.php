<?php

namespace Jonas\Domain\Model;

class User
{
    private int $id;
    public readonly string $name;
    public readonly string $email;
    public array $color = [];

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getColor(): array
    {
        $colorIdCollection = [];
        foreach ($this->color as $color) {
            $colorIdCollection[$color->getId()] = $color->colorName ?? null;
        }

        return $colorIdCollection;
    }

    public function setColor(Color $color): void
    {
        $this->color[$color->getId()] = $color;
    }

    public function setColorIdFromArray(array $colors): void
    {
        foreach ($colors as $color) {
            $this->color[$color] = $color;
        }
    }

    public function getColorId()
    {
        return $this->color;
    }

}