<?php

namespace App\Filament\Resources;

use App\Models\Book;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\BookResource\Pages;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(128),
                TextInput::make('author')
                    ->required()
                    ->maxLength(128),
                Select::make('genres')
                    ->relationship('genres', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Genres'),
                Radio::make('ranking')
                    ->options([
                        1 => '★',
                        2 => '★★',
                        3 => '★★★',
                        4 => '★★★★',
                        5 => '★★★★★',
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('author')
                    ->searchable(),
                TextColumn::make('publication_year')
                    ->label('Year')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('genres.name')
                    ->label('Genres')
                    ->wrap(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(fn(Book $record) => $record->status ? $record->status->label() : null),
                TextColumn::make('ranking')
                    ->label('Ranking')
                    ->sortable()
                    ->getStateUsing(function (Book $record) {
                        if (!$record->ranking) {
                            return '';
                        }
                        return str_repeat('★', $record->ranking);
                    }),
            ])
            ->filters([
                SelectFilter::make('genres')
                    ->relationship('genres', 'name')
                    ->multiple()
                    ->placeholder('Select Genre')
                    ->columnSpan('full'),
            ])
            ->actions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Book';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Books';
    }
}
