<?php

namespace App\Services;


use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function saveProduct($data)
    {
        $this->validate($data);
        $image = $data["image"];
        $filename = uniqid().".".$image->getClientOriginalExtension();
        Storage::disk('public')->put($filename, File::get($image));
        $data["image"] = $filename;

        return $this->repository->saveProduct($data);
    }


    public function updateProduct($id,$data)
    {
        $this->validate($data);
        $image = $data["image"];
        if($image){
            $filename = uniqid().".".$image->getClientOriginalExtension();
            Storage::disk('public')->put($filename, File::get($image));
            $data["image"] = $filename;
        }else{
            unset($data["image"]);
        }

        return $this->repository->updateProduct($id,$data);
    }

    public function validate($data)
    {
        Validator::make($data, [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'categories' => 'required',
        ])->validate();
    }
}
