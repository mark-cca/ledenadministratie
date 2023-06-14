<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familie extends Model
{
    use HasFactory;

    protected $table = 'families';

    protected $fillable = ['naam', 'adres'];

    public function familieleden()
    {
        return $this->hasMany(Familielid::class);
    }

    public function getTotalContributieAttribute()
    {
        $total = $this->familieleden->sum(function ($familielid) {
            return $familielid->contributie_prijs;
        });

        return number_format($total, 2, ',', '.');
    }
}
