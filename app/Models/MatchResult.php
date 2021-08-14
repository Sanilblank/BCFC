<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'matchdetail_id', 'team1_score', 'team2_score',
    ];

    public function matchdetail()
    {
        return $this->belongsTo(MatchDetail::class, 'matchdetail_id', 'id');
    }
}
