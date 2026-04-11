<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            //     Section::make('Product Info')
            //         ->description('')
            //         ->schema([
            //             TextEntry::make('name')
            //                 ->label('Product Name')
            //                 ->weight('bold')
            //                 ->color('primary'),
            //             TextEntry::make('id')
            //                 ->label('Product ID'),
            //             TextEntry::make('sku')
            //                 ->label('Product SKU')
            //                 ->badge()
            //                 ->color('danger'),
            //             TextEntry::make('description')
            //                 ->label('Product Description'),
            //             TextEntry::make('created_at')
            //                 ->label('Product Creation Date')
            //                 ->date('d M Y')
            //                 ->color('info'),
            //         ])
            //         ->columnSpanFull(),
            //     Section::make('Product Price and Stock')
            //         ->description('')
            //         ->schema([
            //             TextEntry::make('price')
            //                 ->label('Product Price')
            //                 ->weight('bold')
            //                 ->color('primary')
            //                 ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
            //                 ->icon('heroicon-o-currency-dollar'),
            //             TextEntry::make('stock')
            //                 ->label('Product Stock')
            //                 ->icon('heroicon-o-cube'),
            //         ])
            //         ->columnSpanFull(),
            //     Section::make('Image and Status')
            //         ->description('')
            //         ->schema([
            //             ImageEntry::make('image')
            //                 ->label('Product Image')
            //                 ->disk('public'),
            //             TextEntry::make('price')
            //                 ->label('Product Price')
            //                 ->weight('bold')
            //                 ->color('primary')
            //                 ->icon('heroicon-o-currency-dollar'),
            //             TextEntry::make('stock')
            //                 ->label('Product Stock')
            //                 ->weight('bold')
            //                 ->color('primary'),
            //             IconEntry::make('is_active')
            //                 ->label('Is_Active?')
            //                 ->boolean(),
            //             IconEntry::make('is_featured')
            //                 ->label('Is_Featured?')
            //                 ->boolean(),
            //         ])
            //         ->columnSpanFull(),
            // ]);
            Tabs::make('Product Tabs')
            ->tabs([
                // Tab 1: Informasi Dasar
                Tab::make('Product Details')
                    ->icon('heroicon-o-information-circle') // [cite: 1539, 2166]
                    ->schema([
                        TextEntry::make('name')->weight('bold')->color('primary'),
                        TextEntry::make('sku')->badge()->color('success'),
                        TextEntry::make('description')->columnSpanFull(),
                    ]),

                // Tab 2: Harga dan Stok
                Tab::make('Pricing & Stock')
                    ->badge(fn ($record) => $record->stock) 
                    ->badgeColor('info')
                    ->icon('heroicon-o-currency-dollar') 
                    ->schema([
                        TextEntry::make('price')->money('IDR'),
                        TextEntry::make('stock'),
                    ]),

                // Tab 3: Media
                Tab::make('Media & Status')
                    ->icon('heroicon-o-photo') // [cite: 1539, 2166]
                    ->schema([
                        ImageEntry::make('image')->disk('public'),
                        IconEntry::make('is_active')->boolean(),
                    ]),
            ])
            ->columnSpanFull() 
            ->vertical(),
    ]);
    }
}
