<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'shirtno',
        'hometown',
        'teamposition_id',
        'slug',
        'status',
        'description',
    ];

    public function teamposition()
    {
        return $this->belongsTo(TeamPosition::class, 'teamposition_id', 'id');
    }
}
