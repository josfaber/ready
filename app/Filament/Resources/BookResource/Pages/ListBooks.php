<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Enums\BookStatus;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\BookResource;
use App\Models\Book;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
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
