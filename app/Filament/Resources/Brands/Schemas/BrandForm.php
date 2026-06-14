<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('logo')
                            ->label(__('Logo'))
                            ->directory('brands')
                            ->image()
                            ->required(fn (string $context) => $context === 'create')
                            ->dehydrated(fn ($state) => filled($state))
                            ->preserveFilenames(false)
                            ->saveUploadedFileUsing(function ($file, $state, $set, $get) {
                                $name = $get('name_en') ?? 'logo';
                                $filename = Str::slug($name);

                                $image = Image::decode($file);
                                $encoded = $image->encodeUsingFileExtension('webp', quality: 80);

                                $webpPath = 'uploads/img/brands/' . $filename . '-' . now()->format('YmdHis') . '.webp';
                                Storage::disk('public')->put($webpPath, (string) $encoded);

                                return $webpPath;
                            }),
                        TextInput::make('name_en')
                            ->label(__('English Name'))
                            ->required(),
                        TextInput::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->required(),
                        TextInput::make('url')
                            ->label(__('URL'))
                            ->url()
                            ->required(),
                    ])
            ]);
    }
}
