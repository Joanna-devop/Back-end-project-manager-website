<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'pid';
    
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'short_description',
        'phase',
        'uid'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }
}
