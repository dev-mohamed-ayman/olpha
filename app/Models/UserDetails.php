<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cities()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }
}
