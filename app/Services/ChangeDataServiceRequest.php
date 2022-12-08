<?php

namespace App\Services;

class ChangeDataServiceRequest
{
    private string $passwordConfirmation;
    private ?string $nameNew;
    private ?string $emailNew;
    private ?string $passwordNew;
    private ?string $passwordRepeatNew;

    public function __construct(string $passwordConfirmation , ?string $nameNew = null, ?string $emailNew = null, ?string $passwordNew = null, ?string $passwordRepeatNew = null)
    {
        $this->passwordConfirmation = $passwordConfirmation;
        $this->nameNew = $nameNew;
        $this->emailNew = $emailNew;
        $this->passwordNew = $passwordNew;
        $this->passwordRepeatNew = $passwordRepeatNew;

    }

    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }

    public function getNameNew(): ?string
    {
        return $this->nameNew;
    }

    public function getEmailNew(): ?string
    {
        return $this->emailNew;
    }

    public function getPasswordNew(): ?string
    {
        return $this->passwordNew;
    }

    public function getPasswordRepeatNew(): ?string
    {
        return $this->passwordRepeatNew;
    }
}