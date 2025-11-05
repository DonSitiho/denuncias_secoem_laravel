<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDashboardConfig extends Model
{
    protected $fillable = ['user_id', 'widget_order'];
    protected $casts = ['widget_order' => 'array'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}