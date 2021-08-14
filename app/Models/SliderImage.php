<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'slider_id',
        'user_id',
        'title',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
