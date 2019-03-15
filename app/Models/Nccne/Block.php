<?php

namespace App\Models\Nccne;

use App\Models\Traits\BlockAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends  Model
{
    use SoftDeletes;
    use BlockAttribute;

    protected $guarded = [];

    protected $connection = 'mysql-weixin';

    public function isShow()
    {
        return $this->status == 'show';
    }
}