<?php

namespace App\Models;

use App\Models\Traits\CategoryAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spider\Utils\Utils;

class Keyword extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keywords';

    /**
     * @var array
     */
    protected $guarded = [];

    public function getslugAttribute()
    {
        return Utils::strReplaceEncode($this->md5);
    }


}