<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'boards';
    protected $fillable = ['name','user_id'];
    protected $primaryKey = 'id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}