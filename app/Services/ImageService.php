<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;


class ImageService
{
    /**
     * Image name with extension
     */
    private string $imageName;

    /**
     * Image Extension
     */
    private string $imageExtension;

    /**
     * Handle storing image with caring of SEO details
     *
     * @param \Illuminate\Http\Request $request
     * @param string $imageKey The image key which in the request
     * @param string $path
     * @return \Illuminate\Http\Request The sent HTTP request without the image key to avoide translatabe conflicts
     */
    public function handleImageDetails(Request $request, string $imageKey, string $path)
    {
        $this->imageName        = $this->addHyphens($request->file($imageKey)->getClientOriginalName());
        $this->imageExtension   = $request->file($imageKey)->getClientOriginalExtension();

        // Get the data from the helper request() to avoid conflicts with (Request, FormRequest, app() Service Container)
        $requestData = $request->all();

        // If user submits the image_name input
        if($request->filled('image_name')) {

            $this->imageName    = $this->addHyphens($request->input('image_name')) . '.' . $request->file($imageKey)->getClientOriginalExtension();
            $imageFullPath      = $this->storeImageWithDifferentName($request, $imageKey, $path);

        } else {
            $imageFullPath  = $this->storeImageWithDefaultName($request, $imageKey, $path);
        }

        // If user submits the image title input
        $request->filled('image_title')
        ? $requestData['image_title'] = $request->input('image_title')
        : $requestData['image_title'] = $this->separateImageNameWithHyphens();

        // If user submits the image title input
        $request->filled('image_alt')
        ? $requestData['image_alt'] = $request->input('image_alt')
        : $requestData['image_alt'] = $this->separateImageNameWithHyphens();

        $requestData['image'] = $imageFullPath;
        $requestData = Arr::except($requestData, 'image_name');

        return $requestData;
    }

    /**
     * Get all needed validation rules for image details
     *
     * @return array
     */
    public function getImageValidationRules() : array
    {
        return [
            'image_name'    => ['nullable', 'string', 'max:255'],
            'image_title'   => ['nullable', 'string', 'max:255'],
            'image_alt'     => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Store the uploaded image with different name depending on the sent image name
     *
     * @param \Illuminate\Http\Request $request
     * @param string $imageKey
     * @param string $path
     * @param string $imageName
     * @return string Full path of the image
     */
    private function storeImageWithDifferentName(Request $request, string $imageKey, string $path) : string
    {
        $imageStorageName = $this->addHyphens($request->input('image_name')) . '.' . $this->imageExtension;
        $fullImageName = null;

        if(File::exists(storage_path("app/public/$path/" . $this->imageName))) {
            $uniqueFolder = md5(Str::random(10) . time());
            $request->file($imageKey)->storeAs("public/" . $path . '/' . $uniqueFolder, $imageStorageName);
            $fullImageName = 'storage/'. $path . '/'. $uniqueFolder . '/' . $imageStorageName;
        } else {
            $request->file($imageKey)->storeAs("public/" . $path, $imageStorageName);
            $fullImageName = 'storage/'. $path . '/' . $imageStorageName;
        }

        return $fullImageName;
    }

    /**
     * Store the uploaded image with its default name
     *
     * @param \Illuminate\Http\Request $request
     * @param string $imageKey
     * @param string $path
     * @param string $imageName
     * @return string Full path of the image
     */
    private function storeImageWithDefaultName(Request $request, string $imageKey, string $path) : string
    {
        if(File::exists(storage_path("app/public/$path/" . $this->imageName))) {
            $uniqueFolder = md5(Str::random(10) . time());
            $request->file($imageKey)->storeAs("public/" . $path . '/' . $uniqueFolder, $this->imageName);
            $fullImageName = 'storage/'. $path . '/' . $uniqueFolder . '/' . $this->imageName;
        } else {
            $request->file($imageKey)->storeAs("public/" . $path, $this->imageName);
            $fullImageName = 'storage/'. $path . '/' . $this->imageName;
        }

        return $fullImageName;
    }

    /**
     * Generate image title depending on the image name separated with hyphens
     *
     * @return string
     */
    private function separateImageNameWithHyphens() : string
    {
        $title = '';

        $imageParts = explode('.', $this->imageName);

        if(isset($imageParts[0])) $title = $this->addHyphens($imageParts[0]);

        return $title;
    }

    /**
     * Replace spaces with hyphens in any sent string
     *
     * @param string $value
     * @return string
     */
    private function addHyphens(string $value) : string
    {
        return str_replace(' ', '-', $value);
    }
}
