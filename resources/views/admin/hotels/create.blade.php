<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New Hotel') }}
        </h2>
    </x-slot>

    <div  class  = "py-12">
    <div  class  = "max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div  class  = "p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
   @if ($errors->any)
                    @foreach ($errors->all as $error)
                        <div class="w-full py-4 text-white bg-red-500 rounded-3xl">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
        <form method = "POST" action = "{{route('admin.hotels.store')}}" enctype = "multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('thumbnail')" />
                        <x-text-input id="thumbnail" class="block w-full mt-1" type="file" name="thumbnail" required autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="city" :value="__('city')" />

                        <select name  = "city_id" id = "city_id" class = "w-full py-3 pl-3 border rounded-lg border-slate-300" required>
                        <option value = "">Choose city</option>
                       @foreach ($cities as $item)
                       <option value ="{{$item->id}}">{{$item->name}}</option>
                       @endforeach

                        </select>

                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="country" :value="__('country')" />

                        <select name  = "country_id" id = "country_id" class = "w-full py-3 pl-3 border rounded-lg border-slate-300" required>
                        <option value = "">Choose country</option>
                             @foreach ($countries as $item)
                       <option value ="{{$item->id}}">{{$item->name}}</option>
                       @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="link_gmaps" :value="__('Link Gmaps')" />
                        <x-text-input id="link_gmaps" class="block w-full mt-1" type="text" name="link_gmaps" :value="old('link_gmaps')" required autofocus autocomplete="link_gmaps" />
                        <x-input-error :messages="$errors->get('link_gmaps')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <textarea name="address" id="address" cols="30" rows="5" class="w-full border border-slate-300 rounded-xl" required autocomplete=""></textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="star_level" :value="__('Star Level')" />
                        <x-text-input id="star_level" class="block w-full mt-1" type="number" name="star_level" :value="old('star_level')" required autofocus autocomplete="star_level" />
                        <x-input-error :messages="$errors->get('star_level')" class="mt-2" />
                    </div>

                    <hr class = "my-5">
                    @for ($i = 0; $i < 3; $i++)


                        <div class="mt-4">
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="photo" class="block w-full mt-1" type="file" name="photos[]" required autofocus autocomplete="photo" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>
 @endfor
                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
