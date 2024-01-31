<?php

namespace App\Core\Onboarding\Domain\Model;

class client
{
    public function __construct(
        private string $firstName,
        private string $lastName,
        private bool $newsletter,
        private string $language,
        private string $source,
        private string $data,
        private string $address
    )
    {
        $this->data = \json_decode($data, true);
        $this->address = \json_decode($address, true);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getNewsletter(): bool
    {
        return $this->newsletter;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getSaludation(): string
    {
        return $this->data['saludation'] ?? null;
    }

    public function getPhone(): string
    {
        return $this->data['phone'] ?? null;
    }

    public function getEmail(): string
    {
        return $this->data['email'] ?? null;
    }

    public function getAddress():  mixed
    {
        return $this->address;
    }

    public function getCountry(): string
    {
        return $this->address['country'] ?? null;
    }

    public function getCity(): string
    {
        return $this->address['city'] ?? null;
    }

    public function getStreet(): string
    {
        return $this->address['street'] ?? null;
    }

    public function getNumber(): string
    {
        return $this->address['number'] ?? null;
    }

    public function getComments(): string
    {
        return $this->address['comments'] ?? null;
    }

}