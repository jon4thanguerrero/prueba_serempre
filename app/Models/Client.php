<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $city_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Client extends Model
{
    use HasFactory;
}
