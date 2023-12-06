<div class="recently-reviewed-container space-y-12 mt-8" wire:init="loadRecentlyReviewed">
    @forelse($recentlyReviewed as $game)
        <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
            <div class="relative flex-none">
                <a href="#">
                    @if($game && array_key_exists('cover', $game))
                        <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="w-48 h-72 object-cover hover:opacity-75 transition ease-in-out duration-150">
                    @else
                        <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-72"></div>
                    @endif
                </a>
                @if(isset($game['rating']))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full" style="right: -20px; bottom: -20px">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ $game['rating'] }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="ml-6 lg:ml-12">
                <a href="#" class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-4">{{ $game['name'] }}</a>
                @isset($game['platforms'])
                    <div class="text-gray-400 mt-1">
                        {{ $game['platforms'] }}
                    </div>
                @endisset
                @if(array_key_exists('summary', $game))
                    <p class="mt-6 text-gray-400 hidden lg:block">
                        {{ $game['summary'] }}
                    </p>
                @endif

            </div>
        </div> <!-- end game -->
    @empty
        @foreach(range(1,3) as $placeholderGame)
            <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                <div class="relative flex-none">
                    <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-64"></div>
                </div>
                <div class="ml-6 lg:ml-12">
                    <div class="text-lg leading-tight mt-4 text-transparent bg-gray-400 inline-block">Title goes here</div>
                    <div class="mt-8 space-y-4 hidden lg:block">
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.</span>
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem.</span>
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.</span>
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
