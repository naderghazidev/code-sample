<?php

namespace App\Enums;

enum ActivityLevel: string
{
    case SEDENTARY = '1.2';
    case LIGHTLY_ACTIVE = '1.375';
    case MODERATELY_ACTIVE = '1.55';
    case VERY_ACTIVE = '1.725';
    case EXTREMELY_ACTIVE = '1.9';
}
