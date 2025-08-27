<a
    href="{{ route('product.detail', ['id' => $data->id]) }}"
    class="{{ $isGrid ? "h-full" : "" }} col-span-1 flex min-w-[40%] max-w-[180px] flex-1 flex-col rounded-2xl bg-white p-2 font-poppins transition-all hover:ring-2 hover:ring-inset hover:ring-primary-50"
>
    <div class="relative">
        <div
            class="absolute left-1.5 top-1.5 z-10 flex w-fit items-center gap-1.5 rounded-full bg-white px-2 py-1.5"
        >
            <img src="{{ asset("assets/icons/spoon-icon.svg") }}" alt="Sold" />
            <span class="text-xs font-semibold text-primary-60">
                {{ $data->total_sold ?? 0 }} Terjual
            </span>
        </div>
        @if ($data->is_promo)
            <div
                style="
                    background-image: url('{{ asset("assets/icons/discount-icon.svg") }}');
                "
                class="absolute bottom-1.5 right-1.5 z-10 flex h-10 w-fit items-center gap-1.5 rounded-full bg-cover px-2 py-1.5"
            >
                <span class="text-xs font-semibold text-white">
                    {{ $data->percent }}%
                </span>
            </div>
        @endif

        <img
            src="{{ Storage::url($data->image) }}"
            alt="{{ $data->name }}"
            class="object-cover w-full aspect-square rounded-xl"
        />
    </div>
    <div>
        <p class="py-2 font-semibold text-black-100">{{ $data->name }}</p>
        <div class="flex items-start gap-1 font-semibold text-primary-60">
            <span>
                <img src="{{ asset("assets/icons/price-icon.svg") }}" />
            </span>
            <div>
                <span>
                    {{ $data->price_afterdiscount ? number_format($data->price_afterdiscount, 0, ",", ".") : number_format($data->price, 0, ",", ".") }}
                </span>
                @if ($data->is_promo)
                    <span
                        class="block -mt-1 text-xs line-through text-black-40"
                    >
                        {{ number_format($data->price, 0, ",", ".") }}
                    </span>
                @endif
            </div>
        </div>
        <p
            class="flex items-center gap-1 mt-1 text-xs font-medium text-primary-60"
        >
            <span>
                <img src="{{ asset("assets/icons/category-icon.svg") }}" />
            </span>
            <span>
                {{ $matchedCategory ? $matchedCategory->name : "Unknown" }}
            </span>
        </p>
    </div>
</a>