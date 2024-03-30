<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// import soft delete
use Illuminate\Database\Eloquent\SoftDeletes;
class book extends Model
{
    use HasFactory,SoftDeletes;
// fillable fields
    protected $fillable = [
        'author',
        'title',
        'publisher',
        'publishyear',
        'edition',
        'isbn',
        'loanable'
    ];
    // relationship: 1 book item can be loaned more times
    public function loans(){return $this->hasMany(Loan::class);}
    }
