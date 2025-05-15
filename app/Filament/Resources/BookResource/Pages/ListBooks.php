<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Models\Book;
use Filament\Actions;
use App\Enums\BookStatus;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\BookResource;
use App\Models\Genre;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    public static string $view = 'book.book-grid';

    public array $books;
    public array $statusFilterOptions;
    public array $genreFilterOptions;

    public function mount(): void
    {
        $this->statusFilterOptions = collect(BookStatus::cases())
            ->mapWithKeys(fn ($status) => [$status->value => $status->label()])
            ->toArray();

        $this->genreFilterOptions = collect(Genre::all())
            ->mapWithKeys(fn ($genre) => [$genre->name => $genre->name])
            ->toArray();

        $query = Book::with('genres');

        // Get status filter
        $status = request('status');
        if ($status) {
            $query->where('status', $status);
        }

        // Get genre filter
        $genre = request('genre');
        if ($genre) {
            $query->whereHas('genres', function (Builder $query) use ($genre) {
                $query->where('name', $genre);
            });
        }

        // Get search term
        $term = request('term');
        if ($term) {
            $query->where(function (Builder $query) use ($term) {
                $query->where('title', 'like', '%' . $term . '%')
                    ->orWhere('author', 'like', '%' . $term . '%');
            });
        }

        // Get sort
        $sort = request('sort');
        if ($sort) {
            $query->orderBy($sort, request('direction', 'asc'));
        }

        // Get results
        $this->books = $query->paginate()->appends([
            'status' => $status,
            'genre' => $genre,
            'sort' => $sort,
            'term' => $term,
        ])->toArray();
    }

    public function getEditUrl($book): string
    {
        return BookResource::getUrl('edit', ['record' => $book['id']]);
    }

    protected function getTableActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('status')
                ->label('Status')
                ->options(
                    collect(BookStatus::cases())
                        ->mapWithKeys(fn ($status) => [$status->value => $status->label()])
                        ->toArray()
                )
                ->placeholder('All Statuses'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'reading' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', BookStatus::READING)),
            'has-read' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', BookStatus::HAS_READ)),
            'want-to-read' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', BookStatus::WANT_TO_READ)),
        ];
    }
}
