<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'location', 'about', 'date', 'type', 'price'
    ];

    protected $hidden = [

    ];

    public function galleries(){
        return $this -> hasMany(Gallery::class, 'tour_packages_id', 'id');
    }
}
