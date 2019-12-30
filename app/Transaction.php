<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model 
{
    use SoftDeletes;

    protected $fillable = [
        'tour_packages_id', 'users_id', 'transaction_total', 'transaction_status',
    ];

    protected $hidden = [

    ];

    public function details(){
        return $this->hasMany(TransactionDetail::class, 'transactions_id','id');
    }

    public function tour_package(){
        return $this->belongsTo(TourPackage::class, 'tour_packages_id','id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'users_id','id');
    }
}
