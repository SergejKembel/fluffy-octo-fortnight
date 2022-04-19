<?php

namespace App\Models;

use Database\Factories\VisitorFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Visitor
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static VisitorFactory factory(...$parameters)
 * @method static Builder|Visitor newModelQuery()
 * @method static Builder|Visitor newQuery()
 * @method static Builder|Visitor onlyTrashed()
 * @method static Builder|Visitor query()
 * @method static Builder|Visitor whereCreatedAt($value)
 * @method static Builder|Visitor whereDeletedAt($value)
 * @method static Builder|Visitor whereFirstname($value)
 * @method static Builder|Visitor whereId($value)
 * @method static Builder|Visitor whereLastname($value)
 * @method static Builder|Visitor whereUpdatedAt($value)
 * @method static Builder|Visitor withTrashed()
 * @method static Builder|Visitor withoutTrashed()
 * @mixin \Eloquent
 */
class Visitor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
