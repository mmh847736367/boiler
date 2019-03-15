<?php

namespace App\Models\Chinawbk;

use App\Models\Traits\Chinawbk\BlockAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends  Model
{
    use SoftDeletes;
    use BlockAttribute;

    protected $guarded = [];

    protected $connection = 'mysql-litecms';

    public function isShow()
    {
        return $this->status == 'show';
    }
}