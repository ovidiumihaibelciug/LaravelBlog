<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Post extends Model
{
    //
    protected $fillable = [
        'content', 'title','user_id'
    ];

    public function scopeFilter($query, $filters) {
        if (isset($filters['month'])){
            if ($month = $filters['month']) {
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }
        }

        if (isset($filters['year'])) {
            if ($year = $filters['year']) {
                $query->whereYear('created_at', $year);
            }
        }
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
