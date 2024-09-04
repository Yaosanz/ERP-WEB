@extends('layouts.landing.master', ['title' => 'Daftar Kendaraan'])

@section('content')
    <div class="w-full py-6 px-4">
        <div class="container mx-auto">
            <!-- Page Title and Search Bar -->
            <div class="flex flex-col md:flex-row md:justify-between mb-5 gap-4">
                <div class="flex flex-col">
                    <h1 class="text-gray-700 font-bold text-lg">Daftar Kendaraan</h1>
                    <p class="text-gray-400 text-xs">Kumpulan data kendaraan yang tersedia</p>
                </div>
                <form action="{{ route('vehicle.index') }}" method="get">
                    <input
                        class="border text-sm rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-sky-700 text-gray-700 w-full"
                        placeholder="Cari Data Kendaraan.." name="search" value="{{ $search }}" />
                </form>
            </div>

            <!-- Vehicle List -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach ($vehicles as $vehicle)
                    <div class="relative bg-white p-4 rounded-lg border shadow-custom">
                        <img src="{{ $vehicle->image }}" alt="{{ $vehicle->name }}" class="object-cover w-full rounded-lg">
                        <div class="absolute top-2 right-2 p-2 {{ $vehicle->status == 'Active' ? 'bg-green-700' : 'bg-red-700' }} rounded-lg text-white">
                            {{ $vehicle->license_plat }}
                        </div>
                        <div class="flex flex-col gap-2 py-2">
                            <div class="flex justify-between">
                                <a href="{{ route('vehicle.show', $vehicle->slug) }}" class="text-gray-700 text-sm hover:underline">{{ $vehicle->name }}</a>
                                <div class="text-gray-500 text-sm">{{ $vehicle->category->name }}</div>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ Str::limit($vehicle->description, 35) }}
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                @if ($vehicle->status == 'Active')
                                    <form action="{{ route('vehicle.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                        <button class="text-gray-700 bg-gray-200 p-2 rounded-lg text-sm text-center hover:bg-gray-300 w-full" type="submit">
                                            Pinjam Kendaraan
                                        </button>
                                    </form>
                                @else
                                    <button class="text-gray-700 bg-gray-200 p-2 rounded-lg text-sm text-center hover:bg-gray-300 w-full cursor-not-allowed">
                                        Kendaraan Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
