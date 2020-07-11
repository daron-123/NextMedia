<?php namespace App\Repositories\Eloquent;



use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    function model()
    {
        return Product::class;
    }

    public function saveProduct($data){
        $product = $this->create($data);

        $product->categories()->sync(explode(",",$data["categories"]));
        return $product;
    }

    public function getProducts($category,$price){
        if($category){
            $this->whereHas("categories",function ($query) use($category){
                $query->where("id",$category);
            });
        }
        if($price){
            $this->orderBy("price",$price);
        }
        return $this->paginate(2);
    }
    public function updateProduct($id,$data){
        $product = $this->find($id);
        $product->update($data);
        $product->categories()->sync(explode(",",$data["categories"]));
        return $product;
    }
}
