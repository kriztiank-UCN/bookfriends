<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

// Custom pivot model
// Validating book statuses (13/35)
class BookUser extends Pivot
{
    public static $statuses = [
        'WANT_TO_READ' => 'Want to read',
        'READING' => 'Reading',
        'READ' => 'Read',
    ];

    public function getActionAttribute()
    {
        return match ($this->status) {
            'WANT_TO_READ' => 'wants to read',
            'READING' => 'is reading',
            'READ' => 'has read',
        };
    }
}
