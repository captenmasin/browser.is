<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static All()
 * @method static static Location()
 * @method static static Browser()
 * @method static static Device()
 */
final class Tool extends Enum
{
    const All = 'home';

    const Device = 'device';

    const Browser = 'browser';

    const Location = 'location';
}
