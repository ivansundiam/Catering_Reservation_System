<?php

namespace App\Actions\Uploads;

use Illuminate\Http\Request;

class StoreImage
{
    public function execute(Request $request, string $inputName, string $folder = 'default', string $destination = 'public' ): ?string
    {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store($folder, $destination);
        }
        
        return null;
    }
}
