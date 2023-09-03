<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class City extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->hasMany(Client::class);
    }
}
