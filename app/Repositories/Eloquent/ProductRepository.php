<?php namespace App\Repositories\Eloquent;



use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{

    function model()
    {
        return Product::class;
    }

    public function saveProduct($data)
    {
        $product = Product::create($data);

        $product->categories()->sync(explode(",",$data["categories"]));
        return $product;
    }

    public function getProducts($category,$price)
    {
        $products = Product::query();
        if($category){
            $products->whereHas("categories",function ($query) use($category){
                $query->where("id",$category);
            });

        }
        if($price){
            $products->orderBy("price",$price);
        }
        return $products->paginate(3);
    }
    public function updateProduct($id,$data)
    {
        $product = $this->find($id);
        $product->update($data);
        $product->categories()->sync(explode(",",$data["categories"]));
        return $product;
    }

    public function find($id)
    {
        return Product::find($id);
    }
}
