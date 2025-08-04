<div>
    <header
        style="
            background-image: url('{{ asset("assets/images/bg-hero.svg") }}');
        "
        class="bg-cover rounded-b-3xl font-poppins"
    >
        <div class="p-6">
            <div class="px-5 py-2 bg-white rounded-3xl">
                <div class="flex items-center gap-1.5">
                    <img
                        src="{{ asset("assets/images/logo.png") }}"
                        class="scale-[0.9]"
                        alt="MyFOOD logo"
                    />
                    <span class="text-lg font-semibold text-primary-50">
                        KasaFood
                    </span>
                </div>
                <div
                    style="
                        background-image: url('{{ asset("assets/images/bg-swiggly-line.svg") }}');
                    "
                    class="rounded-2xl bg-primary-50 px-5 py-3.5 text-center text-white"
                >
                    <span class="block font-semibold tex-sm">Kamu di meja</span>
                    <a
                        href="/"
                        class="mt-1.5 block cursor-pointer text-3xl font-bold"
                    >
                        {{ $tableNumber ?? "" }}
                    </a>
                </div>
            </div>
            <div class="mt-5">
                <h2
                    class="mb-3 text-xl font-semibold text-center text-black-100"
                >
                    Mau Pesan Apa hari ini?
                </h2>
                <form class="flex overflow-hidden rounded-full" method="GET">
                    <input
                        type="search"
                        class="w-full h-12 px-4 rounded-full appearance-none placeholder:font-semibold placeholder:text-black-30"
                        placeholder="Cari Makanan"
                        wire:model.live.debounce.300ms="term"
                    />
                    @if (! $term)
                        <img
                            src="{{ asset("assets/icons/search-icon.svg") }}"
                            alt="Search Icon"
                            class="-ml-10"
                        />
                    @endif
                </form>
            </div>
        </div>
    </header>

    <main
        class="mt-8 mb-24 space-y-6 font-poppins"
        x-data="{ open: @entangle("isCustomerDataComplete") }"
    >
        <div wire:loading class="w-full">
            <div class="w-full my-2">
                <p class="text-center text-black-70">
                    Mencari makanan...
                </p>
            </div>
        </div>
        <div wire:loading.remove>
        @if ($term == "")
            <div>
                <div class="container flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-black-100">
                        Today's promo
                    </h3>
                    <a
                        href="/food/promo"
                        wire:navigate
                        class="block font-semibold text-primary-50"
                    >
                        See More
                    </a>
                </div>
                <div
                    class="flex items-stretch gap-4 py-4 ml-4 overflow-x-auto hide-scrollbar"
                >
                    @if (isset($promos) && count($promos) > 0)
                        @foreach ($promos as $promo)
                            <livewire:components.food-card
                                wire:key="promo-{{ $promo->id }}"
                                :data="$promo"
                                :categories="$categories"
                                :isGrid="false"
                            />
                        @endforeach
                    @else
                        <div class="w-full my-2">
                            <p class="text-center text-black-70">
                                No promo available
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="container">
                <div
                    style="
                        background-image: url('{{ asset("assets/images/bg-container.png") }}');
                    "
                    class="p-6 space-y-6 text-center text-white bg-cover rounded-2xl"
                >
                    <h3 class="text-2xl font-semibold text-left text-black-100">
                        Cita Rasa Lokal
                        <br />
                        Harga Super Lokal!
                    </h3>
                    <a
                        href="/food"
                        wire:navigate
                        class="block px-6 py-2 font-semibold text-white rounded-full w-fit bg-primary-50"
                    >
                        Lihat Semua Menu
                    </a>
                </div>
            </div>

            {{-- <div class="mt-4">
                <div class="container flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-black-100">
                        Favorite Food
                    </h3>
                    <a
                        href="/food/favorite"
                        wire:navigate
                        class="block font-semibold text-primary-50"
                    >
                        See More
                    </a>
                </div>
                <div
                    class="flex items-stretch py-4 ml-4 space-x-4 overflow-x-auto hide-scrollbar"
                >
                    @if (isset($favorites) && count($favorites) > 0)
                        @foreach ($favorites as $favorite)
                            <livewire:components.food-card
                                wire:key="favorite-{{ $favorite->id }}"
                                :data="$favorite"
                                :categories="$categories"
                                :isGrid="false"
                            />
                        @endforeach
                    @else
                        <div class="w-full my-2">
                            <p class="text-center text-black-70">
                                No favorite available
                            </p>
                        </div>
                    @endif
                </div>
            </div> --}}
        @else
            @if ($searchResult->isEmpty())
                <div class="w-full my-2">
                    <p class="text-center text-black-70">
                        Makanan tidak ditemukan
                    </p>
                </div>
            @else
                <div
                    class="container grid items-center grid-cols-2 gap-4 mb-24"
                >
                    @foreach ($searchResult as $result)
                        <livewire:components.food-card
                            wire:key="{{ str()->random(50) }}"
                            :data="$result"
                            :categories="$categories"
                        />
                    @endforeach
                </div>
            @endif
        @endif
        <div x-show="open">
            <livewire:components.customer-modal />
        </div>
    </main>
</div>
