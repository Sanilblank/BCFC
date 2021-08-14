<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchStanding extends Model
{
    use HasFactory;
    protected $fillable =[
            'matchtype_id',
            'team_id',
            'played',
            'win',
            'draw',
            'loss',
            'goalsscored',
            'goalsagainst',
            'goaldifferential',
            'points',
    ];

    public function matchtype()
    {
        return $this->belongsTo(MatchType::class, 'matchtype_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
