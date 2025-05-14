<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Book;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\BookStatus;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BookResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookResource\RelationManagers;

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->query(fn (Builder $query) => $query->where('user_id', auth()->id())) // Restrict to the current user's books
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
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
                    ->getStateUsing(fn (Book $record) => $record->status ? $record->status->label() : null),
                TextColumn::make('ranking')
                    ->label('Ranking')
                    ->sortable()
                    ->getStateUsing(function(Book $record) {
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
            ->actions([
            ])
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
}
