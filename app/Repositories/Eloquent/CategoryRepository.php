<?php namespace App\Repositories\Eloquent;



use App\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository implements CategoryRepositoryInterface
{

    function model()
    {
        return Category::class;
    }

    public function getListCategories()
    {
        return Category::select("id","name")->get()->toArray();
    }

    public function getCategories(){
        return Category::paginate(6);
    }

    public function find($id){
        return Category::find($id);
    }


    public function saveCategory($data){
        return Category::create($data);
    }

    public function updateCategory($data,$id){
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }
}
