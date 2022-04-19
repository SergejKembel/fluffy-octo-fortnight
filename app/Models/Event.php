<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Database\Factories\EventFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @mixin Eloquent
 * @property \App\Models\City $city
 * @method static \Illuminate\Database\Query\Builder|Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|Event withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Event withoutTrashed()
 * @property int $city_id
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCityId($value)
 */
class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'date',
        'city_id'
    ];

    /**
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
