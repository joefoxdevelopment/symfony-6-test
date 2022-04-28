<?php

declare(strict_types=1);

namespace App\Entity;

class User
{
    public function __construct(
        private string $name,
        private int $age,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'age'  => $this->getAge(),
        ];
    }
}
