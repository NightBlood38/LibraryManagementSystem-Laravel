<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
class Loan extends Model
{
    use HasFactory;
    // non-fillable fields: 
    protected guarded = ['id','timestamps'];
    // relationship: a Loan can include 1 book
    public function book(){return $this->BelongsTo(Book::class);}
    // relationship: 1 loan transaction is executed by 1 member
    public function member(){return $this->belongsto(member::class);}
    // check if a member can loan books
    public function is_new_loan_possible(){
        // query member who loans
        $member=$this->member();
        // set check values: loan limit and loan deadline
        $loan_limit=2;
        $bring_back=now()->addDays(15);
        // modify check value by member type
        switch($member->tipus){
            // students
            case 'eh': $loan_limit=5; $bring_back=now()->addMonths(2); break;
            // teachers
            case 'eo': $loan_limit=PHP_INT_MAX; $bring_back=now()->addMonths(12); break;
            // other university citizens
            case 'mp': $loan_limit=4; $bring_back=now()->addMonths(1); break;
            // other
            default: $loan_limit=2; $bring_back=now()->addDays(15);
        }
        // boolean check for loan limit and loan deadline
        return $this->loan_date<$bring_back&&$member->loans()->count()<$loan_limit;
    }
}
