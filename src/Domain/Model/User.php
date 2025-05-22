<?php

namespace Jonas\Domain\Model;

class User
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $email;

    public function __construct(int $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }


}