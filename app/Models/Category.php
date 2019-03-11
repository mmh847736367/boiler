<?php

namespace App\Models;

use App\Models\Traits\CategoryAttribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CategoryAttribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isShow()
    {
        return $this->status == 'show';
    }
}
