<?php

namespace App\Infrastructure\Symplify\PackageBuilder\src\Strings;

use Nette\Utils\Strings;

final class StringFormatConverter
{
    private const BIG_LETTER_REGEX = '#([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]*)#';

    public function camelCaseToUnderscore(string $input): string
    {
        return $this->camelCaseToGlue($input, '_');
    }

    public function camelCaseToGlue(string $input, string $glue): string
    {
        $matches = Strings::matchAll($input, self::BIG_LETTER_REGEX);

        $part = [];

        foreach ($matches as $match)
        {
            $parts[]= $match[0] == \strtoupper($match[0]) ? \strtolower($match[0]) : \lcfirst($match[0]);
        }

        return \implode($glue, $parts);
    }
}