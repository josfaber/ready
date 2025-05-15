<?php

namespace App\Filament\Widgets;

use App\Enums\BookStatus;
use App\Models\Book;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BooksCount extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make(
                label: 'Total books',
                value: Book::query()
                    ->count(),
            )
                ->description('Total books you stored'),
            Stat::make(
                label: 'Reading',
                value: Book::query()
                    ->where('status', BookStatus::READING)
                    ->count(),
            )
                ->description('You\'re busy!')
                ->descriptionIcon('heroicon-o-book-open'),
            Stat::make(
                label: 'Read',
                value: Book::query()
                    ->where('status', BookStatus::HAS_READ)
                    ->count(),
            )
                ->description('More than last year!')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make(
                label: 'Want to read',
                value: Book::query()
                    ->where('status', BookStatus::WANT_TO_READ)
                    ->count(),
            )
                ->description('You will not run out of books!')
                ->descriptionIcon('heroicon-o-heart'),
        ];
    }
}
