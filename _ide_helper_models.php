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
 * App\Models\TrackableJob
 *
 * @property int $id
 * @property string|null $uuid
 * @property string $job
 * @property string $status
 * @property string|null $info
 * @property string|null $email_address
 * @property int $email_sent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereEmailAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereEmailSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackableJob whereUuid($value)
 */
	class TrackableJob extends \Eloquent {}
}

