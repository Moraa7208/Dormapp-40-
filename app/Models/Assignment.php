<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Assignment extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['user_id', 'room_id', 'cleaning_date', 'status'];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Rest Day',
            // Add other default properties as needed
        ]);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function reviews()
    {
        return $this->hasOne(AssignmentReview::class);
    }

    public function cleaningPhotos()
    {
        return $this->hasMany(Media::class);  // You may use this if you want to explicitly define the relationship.
    }

}
