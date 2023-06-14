<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoortLid extends Model
{
    use HasFactory;

    protected $table = 'soort_leden';

    protected $fillable = ['omschrijving','naam'];

    public function familieleden()
    {
        return $this->hasMany(Familielid::class);
    }
}
