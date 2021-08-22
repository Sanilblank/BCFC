<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMatchType extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'matchtype_id'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function matchtype()
    {
        return $this->belongsTo(MatchType::class, 'matchtype_id', 'id');
    }
}
