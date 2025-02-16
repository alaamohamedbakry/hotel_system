@extends('admin.dashboard')

@section('cont')
    <div id="booking" class="py-4">
        <div class="container">
            <div class="mb-4 text-center section-header">
                <h2>Edit Role</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="shadow card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Role Name -->
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $role->name) }}" placeholder="Enter Role Name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Permissions -->
                                <fieldset class="p-3 mt-4 border rounded">
                                    <legend class="w-auto px-2 font-weight-bold">{{ __('Permissions') }}</legend>
                                    
                                    @foreach (config('premission', []) as $premission_code => $premission_name)
                                        @php
                                            $selectedType = $role->permissions->where('premission', $premission_code)->first()->type ?? 'inherit';
                                        @endphp

                                        <div class="mb-3">
                                            <strong class="d-block">{{ $premission_name }}</strong>
                                            <div class="gap-3 d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" 
                                                        name="premissions[{{ $premission_code }}]" 
                                                        value="allow" id="allow_{{ $premission_code }}" 
                                                        {{ $selectedType == 'allow' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="allow_{{ $premission_code }}">Allow</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" 
                                                        name="premissions[{{ $premission_code }}]" 
                                                        value="deny" id="deny_{{ $premission_code }}"
                                                        {{ $selectedType == 'deny' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="deny_{{ $premission_code }}">Deny</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" 
                                                        name="premissions[{{ $premission_code }}]" 
                                                        value="inherit" id="inherit_{{ $premission_code }}"
                                                        {{ $selectedType == 'inherit' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inherit_{{ $premission_code }}">Inherit</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </fieldset>

                                <!-- Submit Button -->
                                <div class="mt-4 text-center">
                                    <button type="submit" class="px-5 btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
