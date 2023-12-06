<div class="most-anticipated-container space-y-10 mt-8" wire:init="loadComingSoon">
    @forelse($comingSoon as $game)
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
    @empty
        @foreach(range(1,4) as $game)
            <div class="game flex">
                <div class="bg-gray-800 h-20 w-16 flex-none"></div>
                <div class="ml-4">
                    <div class="text-transparent bg-gray-700 rounded leading-tight">Title goes here longer</div>
                    <div class="text-transparent bg-gray-700 rounded inline-block text-sm mt-2">Jun 9, 2023</div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
