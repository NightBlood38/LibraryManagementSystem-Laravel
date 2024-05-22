<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\member;
use App\models\book;
class Loan extends Model
{
    use HasFactory;

    // non-fillable fields: 
    protected $guarded = ['id', 'timestamps'];

    // relationship: a Loan can include 1 book
    public function book(){return $this->belongsTo(book::class);}
    // relationship: 1 loan transaction is executed by 1 member
    public function member(){return $this->belongsTo(member::class);}
    // determine maximum number of loanable books based on member type
    public function calculate_loan_limit(){
        switch ($this->member->tipus) {
            // Students
            case 'eh': return 5;
            // Teachers
            case 'eo': return PHP_INT_MAX;
            // Other university citizens
            case 'mp': return 4;
            // Other
            default: return 2;
        }
    }
    // determine loan deadline based on member type
    public function calculate_loan_deadline(){
        $current_date = Carbon::parse($this->loan_date);
        switch ($this->member->tipus) {
            // Students
            case 'eh': return $current_date->addMonths(2);
            // Teachers
            case 'eo': return $current_date->addMonths(12);
            // Other university citizens
            case 'mp': return $current_date->addMonths(1);
            // Other
            default: return $current_date->addDays(15);
        }
    }
    // check if a member can loan books
    public function is_new_loan_possible(){
        $member = $this->member;
        if (!$member) {return false;}
        $loan_limit = $this->calculate_loan_limit();
        $bring_back = $this->calculate_loan_deadline();
        return $this->loan_date < $bring_back && Loan::where('member_id', $member->id)->count()< $loan_limit;
    }
    // override save() method of models (check data before save), set return date
    public function save(array $options = []){
        if (!$this->is_new_loan_possible()) {return false;}
        return parent::save($options);
}
}
