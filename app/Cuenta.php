<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuenta';
    protected $primaryKey = 'id_cuenta';
    public $timestamps = false;

    protected $fillable = [

    ];

    protected $guarded = [

    ];
}
