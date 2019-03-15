<?php

namespace App\Repositories\Chinawbk;

use App\Models\Chinawbk\Block;
use App\Repositories\BaseRepository;

class BlockRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Block::class;
    }

}