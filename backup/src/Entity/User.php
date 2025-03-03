<?php


namespace App\Entity;

use DateTime;
use App\Enum\status;



class User
{


    private int $id;

    private string $nom;

    private string $email;

    private string $mdp;

    private ?string $avatar;

    private Status $status;

    private DateTime $created_at;

    private DateTime $updated_at;

    private string $role;



    public function  __construct(
        string $nom,
        string $email,
        string $mdp,
        ?string $avatar = null,
        Status $status = Status::OFFLINE,
        ?string $role = 'USER'
    ) {
        $this->nom = $nom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->avatar = $avatar;
        $this->status = $status;
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {

        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getmdp(): string
    {
        return $this->mdp;
    }
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
    public function getStatus(): Status
    {
        return $this->status;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }


    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;
        return $this;
    }
    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }
    public function setStatus(Status $status): self
    {
        $this->status = $status;
        return $this;
    }
    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function setUpdatedAt(DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }
}
