<?php

use App\Entity\User;

class inscriptionForm
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    // gérer la demande
    public function HandleRequest(array $data): bool
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->user->setNom($data["nom"]);
            $this->user->setEmail($data["email"]);
            $this->user->setMdp($data["mdp"], PASSWORD_BCRYPT);
            $this->user->setAvatar($data["avatar"]);
            $this->user->setStatus($data["status"]);
            return true;
        }
        return false;
    }

    public function render(): string
    {

        return '
        <form metod="POST" >
        <input type ="text" name="nom" placeholder="nom" required>
        <input type ="email" name="email" placeholder="email" required>
        <input type ="password" name="mdp" placeholder="mdp" required>
        <input type ="file" name="avatar" placeholder="avatar" required>
        <input type ="text" name="status" placeholder="status" required>
        <button type="submit">submit</button>
        </form>
        
        ';
    }
}
