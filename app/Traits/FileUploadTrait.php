<?php

namespace App\Traits;

trait FileUploadTrait
{
    public function uploadFile($file, $folder, $existingFile = null)
    {
        if ($file) {
            // Define the target directory
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/upload/{$folder}";


            // Ensure the folder exists
            if (!file_exists($targetFolder)) {
                mkdir($targetFolder, 0755, true);
            }

            // Delete existing file if present
            if ($existingFile && file_exists(public_path($existingFile))) {
                unlink(public_path($existingFile));
            }

            // Generate a unique filename
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to the target folder
            $file->move($targetFolder, $fileName);

            // Return relative path including 'upload' folder
            return "upload/{$folder}/{$fileName}";
        }

        return $existingFile;
    }
}

