@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="flex items-center justify-content-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Menunggu Verifikasi</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 flex items-center">
            ← Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md divide-y">
        @foreach ($pendingGuides as $guide)
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center space-x-4">
                <img src="{{ $guide->photo_url }}" alt="{{ $guide->name }}" class="w-14 h-14 rounded-full object-cover">
                <div>
                    <h2 class="font-semibold text-lg text-gray-800">{{ $guide->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $guide->city }}</p>
                </div>
            </div>
            <a href="{{ route('admin.guide.show', $guide->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Detail
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
