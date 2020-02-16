<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    //
    protected $table = 'postings';  
    protected $primaryKey = 'id';
    protected $fillable = ['kategori','isi','create_by'];
}
