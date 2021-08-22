<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchScoreDetail extends Model
{
    use HasFactory;

    protected $fillable = ['matchdetail_id', 'team', 'name', 'time'];

    public function matchdetail()
    {
        return $this->belongsTo(MatchDetail::class, 'matchdetail_id', 'id');
    }
}
