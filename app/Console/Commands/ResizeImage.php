<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Intervention\Image\EncodedImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ResizeImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:resize {path : Path to image file or folder} {--up : Increase resolution} {--down : Decrease resolution} {--format=jpg : Output image extension (webp, avif, jpg, jpeg, png)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize images and converts them based on the specified option';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('path');
        $up = $this->option('up');
        $down = $this->option('down');
        $format = $this->option('format');
        $manager = new ImageManager(Driver::class);

        if (!File::exists($path)) {
            $this->error('Path does not exist.');
            return;
        }

        if (!$format) {
            $this->error('Please specify the desired image format.');
            return;
        }

        $allowedFormats = ['png', 'jpeg', 'webp', 'avif'];

        if (!in_array($format, $allowedFormats)) {
            $this->error('Unsupported format. Supported formats: png, jpeg, webp, avif');
            return;
        }

         // Handle single image resizing
         if (is_file($path)) {
            $this->resizeSingleImage($path, $up, $down, $format, $manager);
        } elseif (is_dir($path)) {
            // Handle folder resizing
            $this->resizeImagesInFolder($path, $up, $down, $format, $manager);
        } else {
            $this->error('Invalid path.');
        }

        $this->info('Images resized successfully.');
    }

    private function resizeSingleImage($imagePath, $up, $down, $format, $manager)
    {
        $img = $manager->read($imagePath);

        if ($up) {
            // Increase resolution
            // $img->resize($img->width() * 1.5, $img->height() * 1.5);
        } elseif ($down) {
            // Decrease resolution
            $img->resize($img->width() / 2, $img->height() / 2);
        }

        
        $selectedFormat = $this->convertToFormat($img, $format);

        // Save the image with the desired format
        $selectedFormat->save(public_path('assets/web-images/' . ($up ? 'high' : 'low') . '/' . pathinfo($imagePath, PATHINFO_FILENAME). "." . $format));
        
        $this->info("Added to /web-images/" . ($up ? 'high' : 'low') . "/ folder and converted to " . $format . ": " . $imagePath);
    }

    private function resizeImagesInFolder($folderPath, $up, $down, $format, $manager)
    {
        $images = File::allFiles($folderPath);

        foreach ($images as $image) {
            $imagePath = $image->getPathname();
            
            // Load the image
            $img = $manager->read($imagePath);
            // Resize the image
            if ($up) {
                // Increase resolution
                // $img->resize($img->width() * 1.5, $img->height() * 1.5);
            } elseif ($down) {
                // Decrease resolution
                $img->resize($img->width() / 2, $img->height() / 2);
            }
            $selectedFormat = $this->convertToFormat($img, $format);

            // Save the image with the desired format
            $selectedFormat->save(public_path('assets/web-images/' . ($up ? 'high' : 'low') . '/' . pathinfo($imagePath, PATHINFO_FILENAME). "." . $format));

            // displays message
            $this->info("Added to /web-images/" . ($up ? 'high' : 'low') . "/ folder and converting to " . $format . ": " . $image->getPathname());
        }
    }

    private function convertToFormat($img, $format){
        switch($format){
            case 'png':
                return $img->toPng(100);
            case 'jpeg':
                return $img->toJpeg(100);
            case 'webp':
                return $img->toWebp(100);
            case 'avif':
                return $img->toAvif(100);
        }
    }
}
