<?php

namespace App\Support\Faker;

use Faker\Generator;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

final class FakerImageProvider extends Base
{

    protected string $pathImg;
    protected string $storageDir;



    public function previewImg(string $pathImg, string $storageDir)
    {
        $this->ifDirExists($storageDir);

        $fileName = $this->generatorFile($pathImg, $storageDir);

        return "/storage/$storageDir/$fileName";
    }

    public function mainImg(string $pathImg, string $storageDir)
    {
        $this->ifDirExists($storageDir);

        $fileName = $this->generatorFile($pathImg, $storageDir);

        return "/storage/$storageDir/$fileName";
    }

    protected function ifDirExists(string $storageDir)
    {
        $dirPath = "/public/$storageDir";

        if(!Storage::exists($dirPath)) {
            Storage::makeDirectory($dirPath);
        }
    }

    protected function generatorFile(string $pathImg, string $storageDir)
    {
        return $this->generator->file(
            base_path("tests/Files/img/$pathImg"),
            Storage::path("/public/$storageDir"),
            false
        );

    }
}
