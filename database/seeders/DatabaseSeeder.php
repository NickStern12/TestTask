<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TestTask;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        TestTask::insert([
            'title' => Str::title('article red'),
            'slug' => Str::slug( 'article red','-')
        ]);
        TestTask::insert([
            'title' => Str::title('article two'),
            'slug' => Str::slug( 'article two','-')
        ]);
        TestTask::insert([
            'title' => Str::title('article cite'),
            'slug' => Str::slug( 'article cite','-')
        ]);
        TestTask::insert([
            'title' => Str::title('article phone'),
            'slug' => Str::slug( 'article phone','-')
        ]);


    }
}
