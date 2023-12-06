<div class="game mt-8">
    <div class="relative inline-block">
        <a href="{{ route('games.show', $game['slug']) }}">
            @isset($game['coverImageUrl'])
                <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="h-72 w-full object-cover hover:opacity-75 transition ease-in-out duration-150">
            @else
                <div class="bg-gray-800 w-52 h-72"></div>
            @endisset
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
