<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'administrator';
    case APPLICANT = 'applicant';

    public function title(): string
    {
        return match($this)
        {
            self::ADMIN => 'Administrator',
            self::APPLICANT => 'Applicant',
        };
    }
}
