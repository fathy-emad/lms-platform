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
}
