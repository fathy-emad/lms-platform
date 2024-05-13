<?php

namespace App\Traits;
trait EnumTrait
{
    public function title(): string
    {
        $className = class_basename(static::class);
        return __('enum.' . $className . '.' . $this->name);
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public function translates(): array
    {
        $translations = [];
        $locales = ['en', "ar"];
        $className = class_basename(static::class);
        foreach ($locales as $locale) {
            $translations[$locale] = __('enum.' . $className . '.' . $this->name, [], $locale);
        }

        return $translations;
    }
}
