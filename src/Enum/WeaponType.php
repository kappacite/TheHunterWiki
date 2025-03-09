<?php

namespace App\Enum;

enum WeaponType: string
{
    case RIFLE = 'rifle';
    case SHOTGUN = 'shotgun';
    case BOW = 'bow';
    case HANDGUN = 'handgun';

    public function label(): string
    {
        return match ($this) {
            self::RIFLE => 'Rifle',
            self::SHOTGUN => 'Shotgun',
            self::BOW => 'Bow',
            self::HANDGUN => 'Handgun',
        };
    }

    public static function choices(): array
    {
        return array_combine(
            array_map(fn(self $case) => $case->label(), self::cases()),
            array_map(fn(self $case) => $case->value, self::cases())
        );
    }
}
