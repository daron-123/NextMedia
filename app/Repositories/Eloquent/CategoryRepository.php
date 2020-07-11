<?php namespace App\Repositories\Eloquent;



use App\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    function model()
    {
        return Category::class;
    }

    public function getListCategories(){
        return $this->select("id","name")->get()->toArray();
    }
}
