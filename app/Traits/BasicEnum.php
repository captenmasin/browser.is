<?php

namespace App\Traits;

trait BasicEnum
{
    public static function fromName(string $value): self
    {
        foreach (self::cases() as $status) {
            if( $value === $status->value ){
                return $status;
            }
        }
        throw new \ValueError("$value is not a valid backing value for enum " . self::class );
    }
}
