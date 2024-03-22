<?php

namespace App\Core\Common\Port;

use App\Core\Common\Model\Dimentions;

interface DimensionStorage
{
    public function getCurrentDimensions(): Dimentions;
    public function getCurrentDimensionsOptional(): Dimentions;
    public function processCurrentDimensions(): void;
}