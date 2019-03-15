<?php

namespace App\Repositories\Nccne;

use App\Models\Nccne\Block;
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