<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded  = [];
    protected $fillable = [
        "first_name", "last_name",
    ];
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function City(){
        return $this->belongsTo(City::class);
    }

}
