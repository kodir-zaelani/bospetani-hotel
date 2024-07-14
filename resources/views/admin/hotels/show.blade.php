<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Details Hotel') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">


                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{asset('')}}uploads/{{$hotel->thumbnail}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{$hotel->name}}
                            </h3>
                            <p class="text-sm text-slate-500">
                                {{$hotel->city->name}}, {{$hotel->country->name}}
                            </p>
                        </div>
                    </div>
                    <div  class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Price</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{number_format($hotel->getLowesRoomPrice(), 0, ',', '.')}}/night
                        </h3>
                    </div>
                    <div  class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Star</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{$hotel->star_level}} star
                        </h3>
                    </div>
                    <div class="flex-row items-center hidden md:flex gap-x-3">
                        <a href="{{route('admin.hotels.edit', $hotel)}}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Edit
                        </a>
                        <form action="{{route('admin.hotels.destroy', $hotel)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">
                <h3 class="text-xl font-bold text-indigo-950">Gallery Photos</h3>

                <div class = "flex flex-row gap-x-5">
                    @foreach ($latesphotos as $item)
                    <img src="{{asset('')}}uploads/{{$item->photo}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                    @endforeach
                </div>
                <iframe src="https://www.google.com/maps/embed?{{$hotel->link_gmaps}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div>
                    <h3 class="text-xl font-bold text-indigo-950">Address</h3>
                    <p>
                        {{$hotel->address}}
                    </p>
                </div>

                <hr class="my-5">
                <div class="flex flex-row items-center justify-between">
                    <h3 class="text-xl font-bold text-indigo-950">Rooms Available</h3>
                    <a href="{{route('admin.hotel_rooms.create', $hotel->slug)}}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                        Add New Room
                    </a>
                </div>

                @forelse ($hotel->rooms as $item)

                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{asset('')}}uploads/{{$item->photo}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{$item->name}}
                            </h3>
                            <p class="text-sm text-slate-500">
                                {{$item->total_people}} people
                            </p>
                        </div>
                    </div>
                    <div  class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Price</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{number_format($item->price, 0, ',', '.')}}/night
                        </h3>
                    </div>
                    <div class="flex-row items-center hidden md:flex gap-x-3">
                        <a href="{{route('admin.hotel_rooms.edit', [$hotel->slug, $item])}}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Edit
                        </a>
                        <form action = "{{route('admin.hotel_rooms.destroy', [$hotel->slug, $item])}}" method = "POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <p>Belum ada data kamar terbaru</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
