<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    public $timestamps = false;

    public function jenistanaman()
    {
        return $this->belongsTo('App\Jenistanaman', 'jenis_tanaman', 'name');

    }
}
