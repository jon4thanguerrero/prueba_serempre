<?php

namespace App\DataTransferObject;

/**
 * @author Jonathan Guerrero <jonathan.guerrero.olivera@gmail.com>
 */
class UserDTO
{
    private string $name;
    private string $email;
    private string $password;
    private null|int $id;

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setID(?int $userID): self
    {
        $this->id = $userID;

        return $this;
    }

    public function getID(): null|int
    {
        return $this->id;
    }
}
