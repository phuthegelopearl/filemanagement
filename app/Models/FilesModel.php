<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode', // Barcode of the file
        'file_number', // Unique identifier for the file
        'client_name', // Name of the client associated with the file
        'place_of_allocation', // Place where the file is allocated
        'plot_number', // Plot number associated with the file
        'category', // Category of the file (e.g., Land Ownership Records, Land Allocation Files, etc.)
        // Add additional fields as needed based on your specific requirements
    ];
}
