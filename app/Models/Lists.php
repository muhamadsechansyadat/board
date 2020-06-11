<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Board;
use App\Models\Card;

class Lists extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'lists';
    protected $fillable = ['name','board_id'];
    protected $primaryKey = 'id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function board(){
        return $this->belongsTo(Board::class);
    }

    public function cards(){
        return $this->hasMany(Card::class);
    }
}