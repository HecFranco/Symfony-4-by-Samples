<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $plainPassword;    
    private $firstName;
    private $lastName;
    private $userRoles;    
    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
    }    
    public function getRoles() {
        $user_roles_array = $this->userRoles->toArray();
        $roles = [];
        foreach($user_roles_array as $user_role){
            /* @var UserRole $user_role */
            $roles[] = $user_role->getRole()->getRole();
        }
        return $roles;
    }
    public function addUserRole(UserRole $userRole)
    {
        $this->userRoles[] = $userRole;

        return $this;
    }
    public function removeUserRole(UserRole $userRole)
    {
        $this->userRoles->removeElement($userRole);
    }
    public function getUserRoles()
    {
        return $this->userRoles;
    }    
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSalt()
    {
        return null;
    }    
    public function getId()
    {
        return $this->id;
    }
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }    
    public function setFirstName($firstName = null)
    {
        $this->firstName = $firstName;

        return $this;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }
    public function getLastName()
    {
        return $this->lastName;
    }  
}
