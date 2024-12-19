<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
    
}
