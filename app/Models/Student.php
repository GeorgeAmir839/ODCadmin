<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Student extends Model implements Authenticatable
{
    use HasFactory, Notifiable;
    protected $gaurd='student';
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'phone',
    //     'address',
    //     'avtar',
    //     'avtar',
    //     'college',
    //     'email_verified_at',
    // ];
    public function studentCourses()
    {
        return $this->hasMany(studentCourses::class,'student_id','id');
    }
    public function revisions()
    {
        return $this->hasMany(Revision::class);
    }
}
