<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;
class member extends Model
{
    protected $fillable = ['nev','lakcim','tipus','emailcim'];
    use HasFactory;
    // relationship: 1 member can do 1 or more loans
    public function loans(){return $this->hasMany(Loan::class);}
}
