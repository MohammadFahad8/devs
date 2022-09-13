<?php

namespace App\Models;

use App\Contracts\BookContract;
use Illuminate\Database\Eloquent\Model;

class Zebra extends Model implements BookContract
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zebras';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'title',
                  'body'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function fetchAll()
    {
        return $this->paginate(29);
    }

    public function fetchById($id)
    {

    }


}
