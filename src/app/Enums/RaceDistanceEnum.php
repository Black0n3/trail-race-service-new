<?php

namespace App\Enums;

enum RaceDistanceEnum: string
{
    case FIVE_K = '5k';
    case TEN_K = '10k';
    Case HALF_MARATHON = 'half_marathon';
    Case MARATHON = 'marathon';

    public function getTitle(): string
    {
        return match($this)
        {
            self::FIVE_K => '5k',
            self::TEN_K => '10k',
            self::HALF_MARATHON => 'HalfMarathon',
            self::MARATHON => 'Marathon',
        };
    }

    public static function toArray(): array
    {
        return [
            [
                'id' => self::FIVE_K,
                'name' => self::FIVE_K->getTitle()
            ],
            [
                'id' => self::TEN_K,
                'name' => self::TEN_K->getTitle()
            ],
            [
                'id' => self::HALF_MARATHON,
                'name' => self::HALF_MARATHON->getTitle()
            ],
            [
                'id' => self::MARATHON,
                'name' => self::MARATHON->getTitle()
            ],
        ];
    }
}

