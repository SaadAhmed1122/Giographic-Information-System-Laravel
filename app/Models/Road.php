<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasFactory;

    protected $table = 'roads';

    protected $primaryKey = 'RoadID';

    protected $fillable = [
        'RoadName',
        'RoadType',
        'StartLocation',
        'EndLocation',
        'LinearReferencingPoints',
    ];

    protected $casts = [
        'StartLocation' => 'geometry',
        'EndLocation' => 'geometry',
        'LinearReferencingPoints' => 'json',
    ];

    // Add relationships if needed
    public function roadHistory()
    {
        return $this->hasMany(RoadHistory::class, 'RoadID');
    }

    // public function signs()
    // {
    //     return $this->hasMany(Sign::class, 'RoadID');
    // }

    // public function inspections()
    // {
    //     return $this->hasMany(Inspection::class, 'RoadID');
    // }
}
