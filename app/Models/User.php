<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'national_id',
        'name',
        'birthdate',
        'phone',
        'department_id',
        'program_id',
        'major_id',
        'email',
        'password',
        'agreement',
        'traineeState'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function major(){
        return $this->belongsTo(Major::class);
    }
}
