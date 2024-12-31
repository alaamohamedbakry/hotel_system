@extends('admin.dashboard')
@section('cont')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail Send To {{ $review->name }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Mail Send To {{ $review->name }}</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="shadow card">
                    <div class="card-body">
                        <form name="sentMessage" novalidate="novalidate" method="POST" action="{{route('mail',$review->id)}}">
                            @csrf
                            <div class="mb-3">
                                <label for="greeting" class="form-label">Greeting</label>
                                <input type="text" value="{{ old('greeting') }}" name="greeting" class="form-control"
                                    placeholder="Enter a greeting">
                                @error('greeting')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="mail_body" class="form-label">Mail Body</label>
                                <textarea name="mail_body" id="mail_body" cols="30" rows="5" class="form-control"
                                    placeholder="Enter the mail body">{{ old('mail_body') }}</textarea>
                                @error('mail_body')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="action_text" class="form-label">Action Text</label>
                                <input type="text" value="{{ old('action_text') }}" name="action_text" class="form-control"
                                    placeholder="Enter action text">
                                @error('action_text')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="action_url" class="form-label">Action URL</label>
                                <input type="text" class="form-control" name="action_url" value="{{ old('action_url') }}"
                                    placeholder="Enter action URL">
                                @error('action_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="end_line" class="form-label">End Line</label>
                                <input type="text" class="form-control" name="end_line" value="{{ old('end_line') }}"
                                    placeholder="Enter end line">
                                @error('end_line')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" id="bookingButton" class="btn btn-outline-danger">Send Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection
