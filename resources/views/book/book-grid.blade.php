<section class="flex flex-col gap-y-8 py-8">
    <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
        Books
    </h1>

    <div class="flex flex-wrap justify-left items-center gap-4">

        {{-- Filter Dropdown --}}
        <div class="flex flex-col">
            <div class="text-sm font-bold">Status</div>
            <div class="my-2 flex justify-center">
                <form method="GET" class="flex gap-2">
                    <input type="hidden" name="page" value="{{ request('page') }}">
                    <input type="hidden" name="genre" value="{{ request('genre') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <input type="hidden" name="term" value="{{ request('term') }}">
                    <select name="status" class="border rounded-md px-4 py-2" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        @foreach ($statusFilterOptions as $value => $label)
                            <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        {{-- Filter Genre --}}
        <div class="flex flex-col">
            <div class="text-sm font-bold">Genre</div>
            <div class="my-2 flex justify-center">
                <form method="GET" class="flex gap-2">
                    <input type="hidden" name="page" value="{{ request('page') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <input type="hidden" name="term" value="{{ request('term') }}">
                    <select name="genre" class="border rounded-md px-4 py-2" onchange="this.form.submit()">
                        <option value="">All Genres</option>
                        @foreach ($genreFilterOptions as $value => $label)
                            <option value="{{ $value }}" {{ request('genre') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        {{-- Sort --}}
        <div class="flex flex-col">
            <div class="text-sm font-bold">Sort</div>
            <div class="my-2 flex justify-center">
                <form method="GET" class="flex gap-2">
                    <input type="hidden" name="page" value="{{ request('page') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="genre" value="{{ request('genre') }}">
                    <input type="hidden" name="term" value="{{ request('term') }}">
                    <select name="sort" class="border rounded-md px-4 py-2" onchange="this.form.submit()">
                        <option value="">Entry date</option>
                        <option value="publication_year" {{ request('sort') === 'publication_year' ? 'selected' : '' }}>Year</option>
                        <option value="ranking" {{ request('sort') === 'ranking' ? 'selected' : '' }}>Ranking</option>
                    </select>
                </form>
            </div>
        </div>

        {{-- Search --}}
        <div class="flex flex-col">
            <div class="text-sm font-bold">Search</div>
            <div class="my-2 flex justify-center">
                <form method="GET" class="flex gap-2">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="genre" value="{{ request('genre') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <input type="text" name="term" placeholder="Search..." class="border rounded-md px-4 py-2"
                        value="{{ request('term') }}">
                </form>
            </div>
        </div>
    </div>

    {{-- <pre>{{ json_encode($books, JSON_PRETTY_PRINT) }}</pre> --}}

    {{-- Pagination Links --}}
    @if (count($books['data']) && $books['last_page'] > 1)
    <div class="my-4 flex justify-center gap-2">
        @foreach ($books['links'] as $key => $link)
            @if (
                ($key === 0 && is_null($books['prev_page_url'])) ||
                ($key === count($books['links']) - 1 && is_null($books['next_page_url']))
                )
                @continue;
            @endif
            <a href="{{ $link['url'] }}" class="{{ $link['active'] ? 'font-bold' : '' }}">
                {!! $link['label'] !!}
            </a>
        @endforeach
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach ($books['data'] as $book)
            <a href="{{ $this->getEditUrl($book) }}" class="flex flex-col rounded-md shadow-lg border">
                <div class="flex flex-col px-4 py-5">
                    <h3 class="text-xl font-semibold px-4 py-4 text-center w-full">{{ $book['title'] }}</h3>
                    <h4 class="text-center w-full">
                        <span class="text-sm text-gray-500">by {{ $book['author'] }}</span>
                    </h4>
                </div>
                <div class="flex flex-wrap px-4 py-2 gap-2">
                    @foreach ($book['genres'] as $genre)
                        <span class="inline-block bg-gray-200 text-gray-700 text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $genre['name'] }}
                        </span>
                    @endforeach
                </div>

                <div class="flex items-center justify-between gap-2 px-4 py-4 mt-auto">
                    <div class="flex flex-row text-lg">{{ str_repeat('★', $book['ranking']) }}</div>
                    <div class="text-sm text-right">
                        {{ $book['status'] ? __("enums.book-status-short.{$book['status']}") : __("enums.book-status-short.null") }}
                    </div>
                    <div class="text-sm text-right">{{ $book['publication_year'] }}</div>
                </div>
            </a>
        @endforeach

        @if (!count($books['data']))
            <div class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 xl:col-span-5 flex items-center justify-center">
                <p class="text-gray-500">No books found.</p>
            </div>
        @endif
    </div>
</section>
