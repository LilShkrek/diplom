<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'facilities';

    protected $fillable = [
        'name',
        'buy_date',
        'operation_end_date',
        'inventory_num',
        'employee_id',
    ];

    public function licences()
    {
        return $this->hasMany(Licence::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
