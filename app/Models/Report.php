<?php
// app/Models/Report.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // Use the second database connection for testing
    protected $connection = 'mysql_second';
    
    protected $table = 'reports';
    protected $primaryKey = 'report_id';
    
    protected $fillable = [
        'latitude',
        'longitude',
        'status',
        'description',
        'date_reported'
    ];
}