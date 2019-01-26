<?php

namespace App;

use App\Helpers\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {

    use ModelHelper;
    public $fillable = ['title', 'description', 'code', 'status', 'percentage'];
}
