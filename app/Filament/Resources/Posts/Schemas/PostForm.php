<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    Section::make('Post Details')
                        ->description('Fill in details of the post.')
                        ->icon('heroicon-o-pencil-square') 
                        ->schema([ 
                            Group::make([
                                TextInput::make("title")
                                ->required()
                                ->rules(['min:5'])
                                ->validationMessages([
                                    'min' => 'Judul minimal 5 karakter agar informatif.',
                                ]),
                                TextInput::make("slug")
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->rules(['min:3'])
                                ->validationMessages([
                                    'unique' => 'Maaf, slug ini sudah digunakan postingan lain.',
                                    'min' => 'Slug terlalu pendek, minimal 3 karakter.',
                                ]),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->preload()
                                    ->required()
                                    ->searchable(),
                                ColorPicker::make('color'),
                            ])->columns(2),

                            MarkdownEditor::make('content')
                                ->label('Post Content')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(2),

                Group::make([
                    Section::make('Media')
                        ->icon('heroicon-o-photo') 
                        ->schema([
                            FileUpload::make('image')
                                ->image()
                                ->label('Featured Image')
                                ->required()
                                ->disk('public')
                                ->directory('posts'),
                        ]),

                    Section::make('Meta Settings')
                        ->icon('heroicon-o-information-circle') 
                        ->schema([
                            TagsInput::make('tags'),
                            
                            Checkbox::make('published')
                                ->label('Publish to Public'),
                            DateTimePicker::make('published_at')
                                ->label('Schedule Date'),
                        ]),
                ])->columnSpan(1),

            ])
            ->columns(3); 
    }
}
