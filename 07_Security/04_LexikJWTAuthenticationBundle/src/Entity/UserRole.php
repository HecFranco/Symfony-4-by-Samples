<?php

namespace App\Entity;

class UserRole
{
    private $id;
    private $role;
    private $user;

    public function getId()
    {
        return $this->id;
    }
    public function setRole(ListRole $role = null)
    {
        $this->role = $role;

        return $this;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }
    public function getUser()
    {
        return $this->user;
    }
}

