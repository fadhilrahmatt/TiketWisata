<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tour_packages_id', 'image',
    ];

    protected $hidden = [

    ];

    public function tour_package(){
        return $this ->belongsTo(TourPackage::class, 'tour_packages_id', 'id');
    }
}
