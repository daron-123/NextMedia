<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;


class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {--name=} {--description=}
    {--price=} {--categories=} {--image=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create product from commande line';

    private $service;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $caught = true;
        $data = $this->options();
        while ($caught){
            try {
                $caught = false;
                $data["image"] = $this->uploadImage($data["image"]);
                $this->service->saveProduct($data);
            }
            catch (ValidationException $e){
                $this->printMessages($e->errors());
                foreach ($e->errors() as $key => $messages){
                    $data[$key] = $this->ask("Write the product ".$key);
                }
                $data["image"] = $this->uploadImage($data["image"]);
                $caught = true;
            }
        }

    }

    public function uploadImage($image){

        if($image && (!$image instanceof UploadedFile)){
            $path = str_replace("'","",$image);
            $image = new \Illuminate\Http\File($path);
        }
        return $image;
    }

    public function printMessages($data){

        foreach ($data as $key => $messages) {
            foreach ($messages as $k => $m) {
                echo $m . "\n";
            }
        }
    }
}
