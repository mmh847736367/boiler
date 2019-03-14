<?php


namespace App\Repositories;

use App\Models\Keyword;
use App\Exceptions\GeneralException;
use Carbon\Carbon;
use Spider\Utils\Utils;

class KeywordRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Keyword::class;
    }

    /**
     * @param $slug
     * @return mixed
     * @throw Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getBySlug($slug)
    {
        $md5 = Utils::strReplaceDecode($slug);

        return $this->model
            ->where('md5', $md5)->firstOrFail();
    }


    /**
     * @param $name
     * @return Keyword
     */
    public function create(array $data)
    {
        if($this->keywordExists($data['name'])) {
           return $this->model->where($data)->first();
        }

        $data['md5'] = substr(md5($data['name']),8,16);

        return $this->model
            ->create($data);

    }

    public function createFilter(array $data)
    {
        $exist = $this->model
                ->where('name', $data['name'])
                ->count() > 0;
        if($exist) {
            //已存在，删除 返回1
            return $this->model->where('name', $data['name'])->delete();
        } else {
            if($this->model->withTrashed()->where('name', $data['name'])->count() > 0) {
                //已过滤
                return 2;
            }
            $data['md5'] = substr(md5($data['name']),8,16);
            $data[$this->model->getDeletedAtColumn()] = new Carbon();
            $this->model->create($data);
            return 3;
        }
    }

    public function createFilterMultiple(array $data)
    {
        $add=0;
        $update=0;
        $exist=0;
        foreach ($data as $d) {
            $res = $this->createFilter($d);
            if ($res == 1) {
                $update++;
            }elseif ($res == 2) {
                $exist++;
            }elseif ($res == 3) {
                $add++;
            }
        }
        return [
            'add' => $add,
            'update' => $update,
            'exist' => $exist,
        ];
    }

    public function createMultiple(array $data)
    {
        $models = collect();

        foreach ($data as $d) {
            $model = $this->create($d);
            if(!empty($model)) {
                $models->push($model);
            }
        }

        return $models;
    }


    /**
     * @param $name
     * @return bool
     */
    public function keywordExists($name)
    {
        return $this->model
                ->withTrashed()
                ->where('name', $name)
                ->count() > 0;
    }

}