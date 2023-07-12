<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Result
 *
 * @property int $id
 * @property string $uuid
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result query()
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereUuid($value)
 */
	class Result extends \Eloquent {}
}

