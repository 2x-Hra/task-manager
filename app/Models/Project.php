<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property string name
 *
 */
class Project extends Model
{
    use HasFactory;
    protected $collection = 'tm_projects';
    protected $fillable = [
        'name',

    ];


    public function creator(){
        return $this->hasOne(User::class);
    }
    public function assignee(){
        return $this->hasOne(User::class);
    }

}
