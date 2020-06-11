<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lists;

class Card extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'cards';
    protected $fillable = ['name','list_id','description'];
    protected $primaryKey = 'id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function list(){
        return $this->belongsTo(Lists::class);
    }
}