<?php

namespace App\Enums;

enum BookStatus: string
{
    case HAS_READ = 'has-read';
    case READING = 'reading';
    case WANT_TO_READ = 'want-to-read';

    /**
     * Get translated label for the enum value.
     */
    public function label(): string
    {
        return __("enums.book-status.{$this->value}");
    }
}
