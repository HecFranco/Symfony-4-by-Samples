<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class ListRole
{
  private $id;
  private $role;
  private $createdOn;
  private $userRoles;  
  public function __construct()
  {
    $this->userRoles = new ArrayCollection();
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
  public function getId()
  {
    return $this->id;
  }
  public function setRole($role)
  {
    $this->role = $role;
    return $this;
  }
  public function getRole()
  {
    return $this->role;
  }
  public function setCreatedOn($createdOn)
  {
    $this->createdOn = $createdOn;
    return $this;
  }
  public function getCreatedOn()
  {
    return $this->createdOn;
  }
}

