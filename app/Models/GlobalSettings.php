<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    use HasFactory;

    protected $fillable = ['standaard_contributie', 'jeugd_korting', 'aspirant_korting', 'junior_korting', 'senior_korting', 'oudere_korting','huidig_boekjaar'];
}
