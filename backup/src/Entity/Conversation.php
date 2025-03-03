<?php

namespace App\Entity;

use DateTime;

class Conversation
{
    private int $id;
    private ?string $name;
    private bool $is_groupe;
    private DateTime $created_at;

    public function __construct(
        ?string $name = null,
        bool $is_groupe = false
    ) {
        $this->name = $name;
        $this->is_groupe = $is_groupe;
        $this->created_at = new DateTime();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function isGroupe(): bool
    {
        return $this->is_groupe;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    // Setters
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setIsGroupe(bool $is_groupe): self
    {
        $this->is_groupe = $is_groupe;
        return $this;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
}
