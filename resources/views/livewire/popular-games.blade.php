<div class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16" wire:init="loadPopularGames">
    @forelse($popularGames as $game)
        <div class="game mt-8">
            <div class="relative inline-block">
                <a href="{{ route('games.show', $game['slug']) }}">
                    @if(array_key_exists('cover', $game))
                        <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="h-72 w-full object-cover hover:opacity-75 transition ease-in-out duration-150">
                    @else
                        <div class="bg-gray-800 w-52 h-72"></div>
                    @endif
                </a>
                @if(isset($game['rating']))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right: -20px; bottom: -20px">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ $game['rating'] }}
                        </div>
                    </div>
                @endif
            </div>
            <a href="{{ route('games.show', $game['slug']) }}" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">{{ $game['name'] }}</a>
            <div class="text-gray-400 mt-1">
                {{ $game['platforms'] }}
            </div>
        </div>
    @empty
    @foreach(range(1,12) as $placeholderGame)
        <div class="game mt-8">
            <div class="relative inline-block">
                <div class="bg-gray-800 w-52 h-64"></div>
            </div>
            <div class="inline-block text-transparent text-lg bg-gray-700 leading-tighter rounded hover:text-gray-400 mt-3">Title goes here</div>
            <div class="inline-block mt-2 text-transparent bg-gray-700 rounded">PS4, PC, Switch</div>
        </div>
    @endforeach
@endforelse
</div> <!-- end popular-games -->
