<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class File extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $fillable = [
        'file_number', // Unique identifier for the file
        'client_name', // Name of the client associated with the file
        'omang_no', // Plot number associated with the file
        'status', // Status of the file, default is 'not_in_use'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
