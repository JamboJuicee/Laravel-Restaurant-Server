<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Booking extends Model
{
    use hasUuids;

    protected $fillable = ["name", "email", "datetime", "people", "restaurant_id"];

    public function restaurant() {
        return $this -> belongsTo(Restaurant::class);
    }
}
