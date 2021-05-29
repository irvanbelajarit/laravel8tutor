<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{

    protected $fillable =[
        'username','name','email'
    ];

    public function getUserAttribute(){
        return $this->username.' ' .$this->name;
    }
}
