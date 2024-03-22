<?php

namespace App\Core\Common\Model;

use App\Core\Common\Model\Rmb;

use Ds\Hashable;

class Dimentions implements Hashable, \JsonSerializable
{
    public CONST REGION = 'region';
    public CONST COUNTRY = 'country';
    public CONST LANGUAGE = 'language';
    public CONST BRAND = 'brand';

    private string $hash;

    public function __construct(
        private string $region,
        private string $country,
        private string $language,
        private string $brand
    )
    {
        $this->hash = \implode('_', [$this->getRegion(), $this->getBrand(), $this->getCountry(), $this->getLanguage()]);
    }

    /**
     * @param array<string,  mixed> $dimentions
     */
    public static function  deserialized(array $dimentions): self
    {
        return new self(
            region: $dimentions['region'],
            country: $dimentions['country'],
            language: $dimentions['language'],
            brand: $dimentions['brand'],
        );
    } 

    public static function fromRmb(Rmb $rmb, string $language): self
    {
        return new self(
            region: $rmb->getRegion(),
            country: $rmb->getCountry(),
            language: $language,
            brand: $rmb->getBrand()
        );
    }

    public function equals(mixed $obj): bool
    {
        \assert($obj instanceof self);
        return $this->hash() === $obj->hash();
    }

    public function hash(): string
    {
        return $this->hash;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getLanguage(): string
    {
        return  $this->language;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function toRmb(): Rmb
    {
        return new Rmb($this->getRegion(), $this->getCountry(), $this->getBrand());
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'region' => $this->region,
            'country' => $this->country,
            'language' => $this->language,
            'brand' => $this->brand,
        ];
    }

    public function toQueryPart(): string
    {
        return 'region=' . $this->getRegion() . '&' .
            'brand=' . $this->getBrand() . '&' .
            'country=' . $this->getCountry() . '&' .
            'language=' . $this->getLanguage();
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}