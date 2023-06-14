<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Familielid extends Model
{
    use HasFactory;

    protected $table = 'familieleden';

    protected $fillable = ['naam', 'soort_lid_id', 'geboortedatum', 'familie_id'];

    public function familie()
    {
        return $this->belongsTo(Familie::class);
    }
    public function soortLid()
    {
        return $this->belongsTo(SoortLid::class);
    }

    public function getLeeftijdAttribute()
    {
        return Carbon::parse($this->geboortedatum)->age;
    }

    public function getContributiePrijsAttribute()
    {
        $currentYear = date('Y');
        $boekjaar = Boekjaar::where('jaar', $currentYear)->first();

        if ($boekjaar && $this->soortLid) {
            $contributie = $boekjaar->contributies()->where('soort_lid_id', $this->soort_lid_id)->first();

            if ($contributie) {
                return $contributie->bedrag;
            }
        }

        return null;
    }
}
