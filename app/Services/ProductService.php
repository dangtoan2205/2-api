<?php

namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductService extends BaseService
{
    public function getRepository()
    {
        return ProductRepositoryInterface::class;
    }
    public function getImage($data)
    {
        return $this->repository->getImage($data);
    }
    public function getProductBySlug($slug)
    {
        return $this->repository->getProductBySlug($slug);
    }
    public function saveImage($image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]);
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }
        $dir = 'images/';
        $filename = time() . '.' . $type;
        $location = public_path('images/');
        $relativePath = $dir . $filename;
        if (!File::exists($location)) {
            File::makeDirectory($location, 0777, true);
        }
        file_put_contents($relativePath, $image);
        return $filename;
    }
}
