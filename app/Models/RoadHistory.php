<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadHistory extends Model
{
    use HasFactory;

    protected $table = 'road_history';

    protected $primaryKey = 'HistoryID';

    protected $fillable = [
        'RoadID',
        'UpdatedByUserID',
        'UpdateDate',
        'GraphChanges',
        'AttributeChanges',
    ];

    protected $casts = [
        'UpdateDate' => 'datetime',
        'GraphChanges' => 'json',
        'AttributeChanges' => 'json',
    ];

    // Define relationships if needed
    public function road()
    {
        return $this->belongsTo(Road::class, 'RoadID');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'UpdatedByUserID');
    }
}
