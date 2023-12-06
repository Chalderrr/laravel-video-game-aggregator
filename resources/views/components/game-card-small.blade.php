<div class="game flex">
    <a href="#" class="flex-none">
        @if($game && array_key_exists('cover', $game))
            <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="w-16 hover:opacity-75 transition ease-in-out duration-150">
        @else
            <div class="bg-gray-800 h-20 w-16 flex-none"></div>
        @endif
    </a>
    <div class="ml-4">
        <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
        <div class="text-gray-400 text-sm mt-1">{{ Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}</div>
    </div>
</div>
