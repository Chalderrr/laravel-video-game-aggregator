<div class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16" wire:init="loadPopularGames">
    @forelse($popularGames as $game)
        <x-game-card :game="$game" />
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
