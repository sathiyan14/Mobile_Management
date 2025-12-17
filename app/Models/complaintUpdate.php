<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Complaint;


class complaintUpdate extends Model
{
    //
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    protected $fillable = [
        'complaint_id',
        'status',
        'note'
    ];

    public function updates()
    {
        return $this->hasMany(ComplaintUpdate::class);
    }
}
