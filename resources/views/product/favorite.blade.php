<div x-data="{ open: false }">
    <livewire:components.page-title-nav
        :title="'Favorite Food'"
        wire:key="{{ str()->random(50) }}"
    ></livewire:components.page-title-nav>

    <div class="container grid items-center grid-cols-2 gap-4 mb-24">
        @if (isset($filteredProducts) && count($filteredProducts) > 0)
            @foreach ($filteredProducts as $favorite)
                <livewire:components.food-card
                    wire:key="{{ str()->random(50) }}"
                    :data="$favorite"
                    :categories="$categories"
                />
            @endforeach
        @else
            <div class="w-full col-span-2 my-2">
                <p class="text-center text-black-70">No favorite available</p>
            </div>
        @endif
    </div>

    <div x-show="open">
        <livewire:components.filter-modal
            :selectedCategories="$selectedCategories"
            :categories="$categories"
            wire:key="{{ str()->random(50) }}"
        />
    </div>
</div>
