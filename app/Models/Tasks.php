<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Tasks extends Model
{
    use HasFactory, Notifiable;

    protected $table = "tasks";

    protected $fillable = [
        'user_id', // Ensure user_id is included if tasks are user-specific
        'title',
        'description',
        'deadline',
        'priority', // Added priority field
        'status', // To track if the task is completed or pending
    ];

    // Accessor to format the deadline
    public function getFormattedDeadlineAttribute()
    {
        return Carbon::parse($this->deadline)->format('d M Y, H:i');
    }

    // Scope to fetch upcoming tasks sorted by deadline and priority
    public function scopeUpcomingTasks($query)
    {
        return $query->where('deadline', '>', now())
            ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
            ->orderBy('deadline','asc');
}
}