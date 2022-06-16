<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 *
 * Class Employee
 * @package App\Models
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
