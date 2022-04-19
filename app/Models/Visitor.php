<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @method static \Database\Factories\VisitorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Visitor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Visitor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Visitor withoutTrashed()
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
}
