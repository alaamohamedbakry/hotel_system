@extends('admin.dashboard')
@section('cont')

    <body>
        <!-- نموذج تحميل الصورة فقط -->
        <form action="{{ route('storeroomimage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">

            <label for="image" class="block mb-2 text-sm text-gray-600">Image</label>
            <input type="file" name="image" id="image"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            @error('image')
                <label for='image' class="font-bold text-red-800">{{ $message }}</label>
            @enderror

            <div class="mt-4 d-flex justify-content-center">
                <button type="submit" class="custom-button">SAVE EDITING</button>
            </div>
        </form>

        <!-- عرض الصور المخزنة فقط -->
        <div class="mt-4 row">
            @foreach ($roomimages as $roomimage)
                <div class="mb-4 col">
                    <img class="m-2" src="{{ asset('storage/' . $roomimage->photopath) }}" width="300" height="300">
                    <form method="POST" action="{{ route('removeroomphotos', $roomimage->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE') <!-- هذه هي الطريقة التي تجعلها DELETE -->
                        <button type="submit" class="text-red-500">
                            <i class="fa-solid fa-trash"></i> Delete photo
                        </button>
                    </form>
                    
                </div>
            @endforeach
        </div>
    </body>
@endsection
