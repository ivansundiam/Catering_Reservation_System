<?php

namespace App\Actions\Uploads;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreImage
{
    public function execute(Request $request, string $inputName, string $folder = 'default', string $destination = 'public' ): ?string
    {
        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);

            // Combine the GUID and the original filename
            $guid = Str::uuid()->toString();
            $originalName = $file->getClientOriginalName();
            $newFileName = $guid . '_' . $originalName;

            return $file->storeAs($folder, $newFileName, $destination);
        }
        
        return null;
    }
}
