<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 *
 * Class Client
 * @package App\Models
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
