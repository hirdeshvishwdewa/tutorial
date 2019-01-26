<?php

namespace App;

use App\Helpers\ModelHelper;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements JWTSubject{
	
    use Notifiable, ModelHelper;

    private $classes = [
                            5=>'V', 6=>'VI', 7=>'VII', 8=>'VIII', 9=>'IX', 10=>'X', 11=>'XI', 12=>'XII'
                    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'class', 'school', 'phone', 'status'
    ];

    public function getFillables(){
        return $this->fillable;
    }
    public function getGender(){
        return $this->gender;
    }
    
    public function getPrettyGender(){
        return ucwords($this->gender);
    }

    public function getClassList(){
        return $this->classes;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }
}