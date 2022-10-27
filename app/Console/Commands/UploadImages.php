<?php

namespace App\Console\Commands;

use App\Models\TestTask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:UploadImages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to upload images';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = Storage::disk('public')->allFiles();
        $nameExtension = '';
        foreach (TestTask::get() as $DB_record) {
            if ($DB_record->image == null) {
                $count = 0;
                foreach ($files as $file) {
                    $path_parts = pathinfo($file);
                    if ($path_parts['extension'] == 'jpg' || $path_parts['extension'] == 'jpeg') {
                        if ($DB_record->slug == Str::slug(preg_replace("/(\d.+)/", "", $file), '-')) {
                            TestTask::where('id', '=', $DB_record->id)->update(['image' => public_path() . '/image/' . $file]);
                            break;
                        } else {
                            $count++;
                        }
                    } else {
                        if ($nameExtension != $file) {
                            $nameExtension = $file;
                            error_reporting(E_ALL);
                            ini_set('error_log', storage_path() . '\logs\php-errors.log');
                            error_log("Расширение файла не подходит - " . $nameExtension, 0);
                        }

                        $count++;
                    }
                }
                if ($count == count($files)) {
                    error_reporting(E_ALL);
                    ini_set('error_log', storage_path() . '\logs\php-errors.log');
                    error_log("Файлы для slug не найдены  - " . $DB_record->slug, 0);
                }
            }
            else {
                error_reporting(E_ALL);
                ini_set('error_log', storage_path() . '\logs\php-errors.log');
                error_log("Изображение с  slug" . $DB_record->slug . " уже существует", 0);
            }
        }
    }
}
