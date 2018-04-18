<?php
// src/Entity/SignUp.php
// This is the class that will receive the form data and 
// validate it with the Validator component using constrains
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
class SignUp
{
    /**
     * @Assert\NotBlank(message="Fullname is required")
     * @Assert\Length(
     *     min = 2,
     *     minMessage="The fullname should be at least 2 characters long",
     *     max = 6,
     *     maxMessage="The fullname cannot be longer than 6 characters"
     * )
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z ]*$/",
     *     message="The fullname should only have letters"
     * )
     */
    protected $fullname;
    /**
     * @Assert\NotBlank(message="Email address is required")
     * @Assert\Email(
     *     message="This email is not valid"
     * )
     */
    protected $email;
    /**
     * @Assert\NotBlank(message="Password is required")
     * @Assert\Length(
     *     min = 6,
     *     minMessage="The password should be at least 6 characters long",
     * )
     */
    protected $password;    
    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }
    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $email
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }    
} 