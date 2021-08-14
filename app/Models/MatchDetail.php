<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id', 'team2_id', 'matchtype_id', 'datetime', 'stadium_id', 'completed',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id', 'id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id', 'id');
    }

    public function matchtype()
    {
        return $this->belongsTo(MatchType::class, 'matchtype_id', 'id');
    }

    public function stadium()
    {
        return $this->belongsTo(MatchStadium::class, 'stadium_id', 'id');
    }
}
