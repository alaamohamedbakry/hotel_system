@extends('layouts.master')
@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black; /* تغيير اللون إلى الأسود */
            background-size: 100%;  /* تعديل حجم الأيقونة */
        }
    </style>
</head>
    <body>
        <div class="form-container">
            <form method="POST" action="{{ route('storereview') }}" class="p-6 bg-white border shadow-md rounded-2xl">
                @csrf
                <div class="p-4 border border-gray-200 rounded">
                    <h3 class="mb-4 text-lg text-gray-700 capitalize font-la header-text">
                        <span class="highlighted-text">Add Review</span>
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm text-gray-600">Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" required
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('name')
                                <span class="font-bold text-red-800">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm text-gray-600">Phone <span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="phone" id="phone" required
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('phone')
                                <span class="font-bold text-red-800">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="email" class="block mb-2 text-sm text-gray-600">E-mail <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" required
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('email')
                                <span class="font-bold text-red-800">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="subject" class="block mb-2 text-sm text-gray-600">Subject <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="subject" id="subject" required
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('subject')
                                <span class="font-bold text-red-800">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block mb-2 text-sm text-gray-600">Message <span
                                class="text-red-500">*</span></label>
                        <textarea name="message" id="message" cols="30" rows="4" required
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        @error('message')
                            <span class="font-bold text-red-800">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
        @if (session('success'))
        <div class="modal" tabindex="-1" id="reviewModel">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <p>{{ session('success') }}.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('reviewModel'));
                modal.show();
            });
        </script>
        @endif
          <!-- Bootstrap JS and Popper.js (required for Bootstrap components like the carousel) -->
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
@endsection
