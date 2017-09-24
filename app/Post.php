<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    //
    protected $fillable = [
        'content', 'title','user_id','tag_id','slug',
    ];


    public function getShortContentAttribute($key)
    {
        return substr($this->content,0, random_int(60, 150)) . '...';
    }

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



    public static function archives () {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')->groupBy('year','month')->orderBy('created_at','DESC')->get()->toArray();
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function getTags() {

        $tags = $this->tags();

        $tagsName = array();
        foreach ($tags as $tag) {
            array_push($tagsName, $tag->name);
        }


        return $tagsName;
    }
}
