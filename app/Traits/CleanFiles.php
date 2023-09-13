<?php

namespace App\Traits;

use Str;
use App\Services\FileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait CleanFiles
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        /**
         * Booted deleted method
         */
        static::deleted(function ($record) {

            if($record->uniqueFiles) {

                foreach ($record->uniqueFiles as $field => $value) {
                    FileService::deleteFile(str_replace('storage', 'public', $record->{$field}));
                    self::deleteUniqueFile($record->{$field}, $record->filesPath);
                }

            } elseif ($record->filesFields) {
                foreach ($record->filesFields as $field) {
                    FileService::deleteFile(str_replace('storage', 'public', $record->{$field}));
                }

            }
        });

        /**
         * Booted updated method
         */
        static::updated(function ($record) {
            if($record->uniqueFiles) {

                foreach ($record->uniqueFiles as $field => $value) {
                    if ($record->wasChanged($field) && ($record->getOriginal($field) != $record->$field)) {
                        FileService::deleteFile(str_replace('storage', 'public', $record->getOriginal($field)));
                        self::deleteUniqueFile($record->getOriginal($field), $record->filesPath);
                    }
                }

            } elseif($record->filesFields) {

                foreach ($record->filesFields as $field) {
                    if ($record->wasChanged($field)) {
                        FileService::deleteFile(str_replace('storage', 'public', $record->getOriginal($field)));
                    }
                }

            }
        });

    }

    /**
     * Delete the directory of the unique file
     *
     * @param string $path
     */
    public static function deleteUniqueFile(string $fieldPath, string $modelFilesPath)
    {
        $pathParts = explode('/', dirname($fieldPath));
        if(end($pathParts) != $modelFilesPath) File::deleteDirectory(dirname($fieldPath));
    }
}
