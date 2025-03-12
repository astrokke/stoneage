<?php

namespace Stoneage\Back\interface;

interface UserInterface
{
    public function setRoles(array $roles): void;
    public function getRoles(): array;

    public function getPassword(): string;
    public function setPassword(string $password): void;
}