<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        FileUpload::make('avatar')
                            ->label(__('Avatar'))
                            ->directory('users')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->dehydrated(fn ($state) => filled($state))
                            ->disk('public')
                            ->directory('uploads/img/users')
                            ->preserveFilenames(false)
                            ->saveUploadedFileUsing(function ($file, $state, $set, $get) {
                                $name = $get('name') ?? 'avatar';
                                $filename = Str::slug($name);

                                $image = Image::decode($file);
                                $encoded = $image->encodeUsingFileExtension('webp', quality: 80);

                                $webpPath = 'uploads/img/users/' . $filename . '-' . now()->format('YmdHis') . '.webp';
                                Storage::disk('public')->put($webpPath, (string) $encoded);

                                return $webpPath;
                            }),
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->required(),
                        // TextInput::make('phone_number')
                        //     ->label(__('Phone Number'))
                        //     ->required(),
                        Select::make('role')
                            ->label(__('Role'))
                            ->relationship('role', 'label_'. app()->getLocale())
                            ->preload()
                            ->searchable(),
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->required()
                            ->hiddenOn('edit')
                            ->minLength(8),
                        TextInput::make('password_confirmation')
                            ->label(__('Password Confirmation'))
                            ->password()
                            ->required()
                            ->hiddenOn('edit')
                            ->same('password'),
                    ]),
            ]);
    }
}
