<?php

namespace Agenciafmd\Banners\Database\Seeders;

use Agenciafmd\Banners\Models\Banner;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannersTableSeeder extends Seeder
{
    protected int $total = 3;

    public function run(): void
    {
        Banner::query()
            ->truncate();

        DB::table('media')
            ->where('model_type', 'Agenciafmd\\Banners\\Models\\Banner')
            ->delete();

        $faker = Factory::create('pt_BR');

        $this->command->getOutput()
            ->progressStart($this->total);

        Banner::factory($this->total)
            ->create()
            ->each(function ($banner) use ($faker) {
                collect(['desktop', 'notebook', 'mobile'])->each(function($type) use ($faker, $banner) {
                    $fakerDir = __DIR__ . "/../Faker/banners/{$type}";
                    if(file_exists(base_path("database/faker/banners/{$type}"))) {
                        $fakerDir = base_path("database/faker/banners/{$type}");
                    }

                    $sourceFile = $faker->file($fakerDir, storage_path('admix/tmp'));
                    $targetFile = Storage::putFile('tmp', new HttpFile($sourceFile));

                    $banner->doUploadMultiple($targetFile, $type);
                });

                $this->command->getOutput()
                    ->progressAdvance();
            });

        $this->command->getOutput()
            ->progressFinish();
    }
}