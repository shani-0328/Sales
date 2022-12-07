<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='details';
    protected $primaryKey='Id';
    protected $fillable=[
        'FirstName',
        'LastName',
        'Email',
        'Tele',
        'JoinDate',
        'WorkingRoute',
        'Comments'
    ];

}
