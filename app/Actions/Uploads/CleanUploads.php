<?php

namespace App\Actions\Uploads;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Reservation;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CleanUploads
{
    public function execute($model)
    {
        // Check if a month has passed since the last cleanup
        if ($this->isTimeToCleanUp()){
            switch($model){
                case 'user':
                    $modelFiles = User::pluck('id_verify_img')->toArray();
                    $folder = 'ids';
                    break;
                case 'inventory':
                    $modelFiles = Inventory::pluck('item_img')->toArray();
                    $folder = 'items';
                    break;
                case 'reservation':
                    // Fetch filenames for reservation receipt images
                    $receiptImages = Reservation::pluck('receipt_img')->toArray();
                    
                    // Combine and explode to separate filenames
                    $modelFiles = [];
                    foreach ($receiptImages as $imagePaths) {
                        $imagePaths = explode(',', $imagePaths);
                        $modelFiles = array_merge($modelFiles, $imagePaths);
                    }

                    $folder = 'receipts';
                    break;
                default: 
                    $modelFiles = [];
                    $folder = '';
                    break;
            }

            $files = Storage::disk('public')->allFiles($folder); 

            // Get filenames that are in storage but not in the database
            $filesToDelete = array_diff($files, $modelFiles);

            // identify if files were removed from storage
            $cleanedUploads = false;

            // Delete files not found in the database  
            foreach ($filesToDelete as $file) {
                Storage::disk('public')->delete($file);
                $cleanedUploads = true;
            }

            // Update last cleanup timestamp
            if($cleanedUploads){
                Cache::put('last_cleanup_time', Carbon::now());
                Log::info('Updated last_cleanup_time' . Carbon::now());
            }

        }
    }

    protected function isTimeToCleanUp()
    {
        $lastCleanupTime = Cache::get('last_cleanup_time');

        if (!$lastCleanupTime) {
            return true; // No cleanup has been done yet
        }

        // Check if a month has passed since the last cleanup
        return Carbon::now()->diffInMonths($lastCleanupTime) >= 1;
    }
}
