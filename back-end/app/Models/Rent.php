<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property boolean $status
 * @property string $name
 *
 * Class Rent
 * @package App\Models
 */
class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
      'status',
      'name'
    ];

    /**
     * @param $query Builder
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', '=', 0);
    }
}
