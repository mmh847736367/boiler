<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    public function getEnableCategories()
    {
        if(Cache::has('nav')) {
            $categories = Cache::get('nav');
        } else {
            $categories = $this->model
                ->where([['status', '=', 'show'], ['type', '=', 0]])
                ->get(['id', 'name', 'title', 'slug']);
            Cache::put('nav', $categories, 3*24*60);
        }
        return $categories;
    }

    public function getSubCategories()
    {
        if(Cache::has('nav.sub')) {
            $categories = Cache::get('nav.sub');
        } else {
            $categories =  $this->model
                ->where('type', '>', '0')
                ->get(['id', 'name', 'title', 'slug', 'type', 'is_hot'])
                ->groupBy('type');
            Cache::put('nav.sub', $categories, 3*24*60);
        }

        return $categories;
    }

    public function getPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}