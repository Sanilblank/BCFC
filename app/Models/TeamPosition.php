<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPosition extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function teammembers()
    {
        return $this->hasMany(TeamMember::class, 'teamposition_id', 'id');
    }
}
