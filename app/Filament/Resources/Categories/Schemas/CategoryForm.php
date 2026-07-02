<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        FileUpload::make('icon')
                            ->label(__('Icon'))
                            ->directory('categories')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->required(fn (string $context) => $context === 'create')
                            ->dehydrated(fn ($state) => filled($state))
                            ->disk('public')
                            ->directory('uploads/img/categories')
                            ->preserveFilenames(false)
                            ->saveUploadedFileUsing(function ($file, $state, $set, $get) {
                                $name = $get('name_en') ?? 'icon';
                                $filename = Str::slug($name);

                                $image = Image::decode($file);
                                $encoded = $image->encodeUsingFileExtension('webp', quality: 80);

                                $webpPath = 'uploads/img/categories/' . $filename . '-' . now()->format('YmdHis') . '.webp';
                                Storage::disk('public')->put($webpPath, (string) $encoded);

                                return $webpPath;
                            }),
                        TextInput::make('name_en')
                            ->label(__('English Name'))
                            ->required(),
                        TextInput::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->required(),
                    ])
            ]);
    }
}
