<?php

namespace App\Core\Onboarding\Domain\Model;

class Client
{
    /**
     * @param array<mixed> $data
     * @param array<mixed> $address
     */
    public function __construct(
        private int $id,
        private string $firstName,
        private string $lastName,
        private bool $newsletter,
        private string $language,
        private string $source,
        private string $brand,
        private string $country,
        private string $region,
        private array $data,
        private array $address
    )
    {
    }

    public static function createFromJson(string $json): Client
    {
        $keys = [
            'id',
            'firstName',
            'lastName',
            'newsletter',
            'language',
            'source',
            'brand',
            'country',
            'region',
            'data',
            'address',
        ];

        $arguments = [];

        $data = \json_decode($json, true);

        foreach ($keys as $key) {
            $arguments[$key] = $data[$key] ?? '';
            unset($data[$key]);
        }

        $argument['id'] = \intval($arguments['id']);
        $arguments['firstName'] = \strval($arguments['firstName']);
        $arguments['lastName'] = \strval($arguments['lastName']);
        $arguments['newsletter'] = \boolval($arguments['newsletter']);
        $arguments['language'] = \strval($arguments['language']);
        $arguments['source'] = \strval($arguments['source']);
        $arguments['brand'] = \strval($arguments['brand']);
        $arguments['country'] = \strval($arguments['country']);
        $arguments['region'] = \strval($arguments['region']);
        $arguments['data'] = \is_array($arguments['data']) ? $arguments['data'] : \json_decode($data, true) ?? [];
        $arguments['address'] = \is_array($arguments['address']) ? $arguments['address'] : \json_decode($arguments, true) ?? []; 

        return new Client(...$arguments);
    }

    public static function createFromArray(array $data): Client
    {
        $keys = [
            'id',
            'firstName',
            'lastName',
            'newsletter',
            'language',
            'source',
            'brand',
            'country',
            'region',
            'data',
            'address',
        ];

        $arguments = [];

        foreach ($keys as $key) {
            $arguments[$key] = $data[$key] ?? '';
            unset($data[$key]);
        }

        $argument['id'] = \intval($arguments['id']);
        $arguments['firstName'] = \strval($arguments['firstName']);
        $arguments['lastName'] = \strval($arguments['lastName']);
        $arguments['newsletter'] = \boolval($arguments['newsletter']);
        $arguments['language'] = \strval($arguments['language']);
        $arguments['source'] = \strval($arguments['source']);
        $arguments['brand'] = \strval($arguments['brand']);
        $arguments['country'] = \strval($arguments['country']);
        $arguments['region'] = \strval($arguments['region']);
        $arguments['data'] = \is_array($arguments['data']) ? $arguments['data'] : \json_decode($data, true) ?? [];
        $arguments['address'] = \is_array($arguments['address']) ? $arguments['address'] : \json_decode($arguments, true) ?? []; 

        return new Client(...$arguments);
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getSource(): string
    {
        return $this->source;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getcountry(): Int
    {
        return $this->country;
    }

    public function getBrand(): string
    {
        return $this->brand;
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

    public function getAddressCountry(): string
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

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'newsletter' => $this->getNewsletter(),
            'language' => $this->getLanguage(),
            'source' => $this->getSource(),
            'brand' => $this->getBrand(),
            'country' => $this->getcountry(),
            'region' => $this->getRegion(),
            'data' => $this->getData(),
            'address' => $this->getAddress(),
        ];
    }

}