<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributie extends Model
{
    use HasFactory;

    protected $table = 'contributies';

    protected $fillable = ['leeftijd', 'soort_lid_id', 'bedrag','boekjaar_id'];

    public function soortLid()
    {
        return $this->belongsTo(SoortLid::class);
    }
}
