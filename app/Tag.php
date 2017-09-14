<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Tag extends Model
{
    //
    public function posts() {
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName() {
        return 'name';
    }

    public function getModel()
    {
        return Tag;
    }

    public function paginate($limit = 10) {
        return $this->getModel()->paginate($limit);
    }


}
