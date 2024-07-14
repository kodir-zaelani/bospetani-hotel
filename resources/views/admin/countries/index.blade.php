<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Countries') }}
            </h2>
            <a href="{{route('admin.countries.create')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($countries as $item)
                <div class = "flex flex-row items-center justify-between item-card">
                <div class = "flex flex-row items-center gap-x-3">
                <div class = "flex flex-col">
                <p   class = "text-sm text-slate-500">Name</p>
                <h3  class = "text-xl font-bold text-indigo-950">
                                {{$item->name}}
                            </h3>
                        </div>
                    </div>
                    <div class = "flex-col hidden md:flex">
                    <p   class = "text-sm text-slate-500">Date</p>
                    <h3  class = "text-xl font-bold text-left text-indigo-950">
                            {{$item->created_at->format('M d, Y')}}
                        </h3>
                    </div>
                    <div class = "flex-row items-center hidden md:flex gap-x-3">
                    <a   href  = "{{route('admin.countries.edit', $item)}}" class = "px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Edit
                        </a>
                        <form action = "{{route('admin.countries.destroy', $item)}}" method = "POST">
                            @csrf
                            @method('DELETE')
                            <button type = "submit" class = "px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
                @empty
                belum ada data terbaru
                @endforelse
                {{$countries->links()}}


            </div>
        </div>
    </div>
</x-app-layout>
