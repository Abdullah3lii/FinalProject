<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
