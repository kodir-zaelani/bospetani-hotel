<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Hotel Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{asset('')}}uploads/{{$hotel->thumbnail}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class = "text-xl font-bold text-indigo-950">
                                {{$hotel->name}}
                            </h3>
                            <p class = "text-sm text-slate-500">
                                {{$hotel->city->name}}, {{$hotel->country->name}}
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                <form method="POST" action="{{route('admin.hotel_rooms.update', $hotelroom)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block w-full mt-1" type="text" value="{{$hotelroom->name}}" name="name"
                          required autofocus autocomplete="name"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Current Photo')" />
                        <img src="{{asset('')}}uploads/{{$hotelroom->photo}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <x-text-input id="photo" class="block w-full mt-1" type="file" name="photo"  autofocus autocomplete="photo" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('price')" />
                        <x-text-input id="price" class="block w-full mt-1" type="number" value="{{$hotelroom->price}}" name="price"
                         required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="total_people" :value="__('Total People')" />
                        <x-text-input id="total_people" class="block w-full mt-1" type="number" value="{{$hotelroom->total_people}}" name="total_people"
                         required autofocus autocomplete="total_people" />
                        <x-input-error :messages="$errors->get('total_people')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Update Hotel Room
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
