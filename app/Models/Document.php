<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
       'document_name',
       'attachment'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
