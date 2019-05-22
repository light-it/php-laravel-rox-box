<?php

namespace App\DTO;

use Illuminate\Support\Collection;
use SchulzeFelix\DataTransferObject\DataTransferObject;

class VisitorDTO extends DataTransferObject
{

    const NAME = 'name';
    const PHONE = 'phone';
    const EMAIL = 'email';

    /** @var string $name */
    private $name;

    /** @var string $phone */
    private $phone;

    /** @var string $email */
    private $email;

    /**
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return VisitorDTO
     */
    public function setNameAttribute(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneAttribute(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return VisitorDTO
     */
    public function setPhoneAttribute(?string $phone = null): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailAttribute(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return VisitorDTO
     */
    public function setEmailAttribute(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

}
