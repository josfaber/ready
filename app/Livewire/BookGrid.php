<?php

namespace App\Livewire;

use App\Models\Book;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Livewire\Component;
use Livewire\WithPagination;

class BookGrid extends Component
{
    use InteractsWithActions;
    use WithPagination;

    public ?string $resource = \App\Filament\Resources\BookResource::class;

    public function mount(): void
    {
        Filament::registerRenderHook(
            'resource.pages.list-records.table.before',
            fn () => view('livewire.book-grid'),
        );
    }

    public function render()
    {
        $resource = $this->resource::getModel();
        $books = $resource::paginate(12); // Adjust the pagination as needed

        return view('livewire.book-grid', [
            'books' => $books,
            'resource' => $this->resource,
        ]);
    }

    public function editAction(Book $record): Action
    {
        return Action::make('edit')
            ->url(fn () => $this->resource::getUrl('edit', ['record' => $record]))
            ->icon('heroicon-o-pencil-square');
    }
}
}
