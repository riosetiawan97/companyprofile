<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'kategori';    
    protected $primaryKey = 'id';
    protected $fillable = ['nama','deskripsi','flag_active'];
}
