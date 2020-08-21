<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded =[];

public function profileImage()

{
$imagePath =   ($this->image) ? $this->image : 'profile/app/public/uploads/5Z1rnbScVFV0Jk22GEQkY2JiQE8D7iZQmUMF6EhL.jpeg';
    return '/storage/' . $imagePath;




}


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function task()
    {
        return $this->hasMany(Task::class);
    }

}
