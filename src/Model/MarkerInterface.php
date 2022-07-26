<?php

namespace App\Model;

use DateTimeInterface;

interface MarkerInterface
{
    public function setLatitude(string $latitude): self;
    public function getLatitude(): ?string;
    public function setLongitude(string $longitude): self;
    public function getLongitude(): ?string;
    public function setDate(DateTimeInterface $date): self;
    public function getDate(): ?DateTimeInterface;
}
