<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'licences';

    protected $fillable = [
        'name',
        'buy_date',
        'start_date',
        'end_date',
        'key',
        'facility_id',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
