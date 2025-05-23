<?php

namespace Jonas\Domain\Model;

class User
{
    private int $id;
    public readonly string $name;
    public readonly string $email;
    public readonly ?Color $color;

    public function __construct(string $name, string $email, Color $color = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->color = $color;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }


}