<?php

namespace App\Filament\Resources\Cars\Schemas;

use App\Models\Brand;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('images')
                            ->label(__('Images'))
                            ->multiple()
                            ->image()
                            ->reorderable()
                            ->appendFiles()
                            ->dehydrated(fn ($state) => filled($state))
                            ->disk('public')
                            ->directory('uploads/img/cars')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->saveUploadedFileUsing(function ($file, $get) {
                                $brandId = $get('brand_id');
                                $brandName = $brandId ? (Brand::find($brandId)?->name_en ?? 'brand') : 'generic';

                                $carName = $get('name_en') ?? 'car';

                                static $imageIndex = 1;
                                $currentNumber = $imageIndex++;

                                $baseSlug = Str::slug($brandName . ' ' . $carName);

                                $filename = "{$baseSlug}-img{$currentNumber}-" . now()->format('YmdHis') . '.webp';
                                $webpPath = "uploads/img/cars/{$filename}";

                                $image = Image::decode($file);
                                $encoded = $image->encodeUsingFileExtension('webp', quality: 80);

                                Storage::disk('public')->put($webpPath, (string) $encoded);

                                return $webpPath;
                            }),
                        Select::make('brand_id')
                            ->relationship('brand', 'name_' . app()->getLocale())
                            ->label(__('Brand'))
                            ->required(),
                        Select::make('category_id')
                            ->relationship('category', 'name_' . app()->getLocale())
                            ->label(__('Category'))
                            ->required(),
                        TextInput::make('name_en')
                            ->label(__('English Name'))
                            ->required(),
                        TextInput::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->required(),
                        TextInput::make('daily_price')
                            ->label(__('Price'))
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->step(0.01)
                            ->suffix('$'),

                    ])
            ]);
    }
}
