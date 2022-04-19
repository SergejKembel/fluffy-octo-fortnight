<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\City
 *
 * @property int $id
 * @property int $zip_code
 * @property string $city
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Event[] $events
 * @property-read int|null $events_count
 * @method static \Database\Factories\CityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Query\Builder|City onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereZipCode($value)
 * @method static \Illuminate\Database\Query\Builder|City withTrashed()
 * @method static \Illuminate\Database\Query\Builder|City withoutTrashed()
 * @mixin \Eloquent
 */
class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'city',
        'zip_code'
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'city_id');
    }
}
