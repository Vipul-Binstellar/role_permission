@extends('layouts.app')


@section('content')
<div class="content-wrapper">



<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 page-header-title">Role Update</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $role->id }} disabled">

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $role->name }}" placeholder="name"  disabled />
                            <label for="name">Role</label>
                            @error('name')
                                <small class="red-text ml-10" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="input-field col-sm-12">
                            <div class="card">
                                <h5 class="card-header">Table Basic</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Module Permission</th>
                                                <th>Create</th>
                                                <th>Read</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accessData as $key => $value)
                                                @php
                                                    $data = $permissionData
                                                        ->where('module', $value)
                                                        ->where('role_id', $role->id)
                                                        ->first();
                                                    if (!empty($data)) {
                                                        $create = $data['create'] == 'on' ? 'checked' : '';
                                                        $read = $data['read'] == 'on' ? 'checked' : '';
                                                        $update = $data['update'] == 'on' ? 'checked' : '';
                                                        $delete = $data['delete'] == 'on' ? 'checked' : '';
                                                    }
                                                @endphp
                                                @if (!empty($data) && $data['module'] == $value)
                                                    <tr>
                                                        <td>{{ $value }}</td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][create]"
                                                                    {{ $create }} disabled/>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][read]"
                                                                    {{ $read }} disabled/>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][update]"
                                                                    {{ $update }} disabled/>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][delete]"
                                                                    {{ $delete }} disabled />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{ $value }}</td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][create]" disabled/>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][read]" disabled/>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][update]" disabled/>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permission[{{ $key }}][delete]" disabled/>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
                        </div>
                        {{-- <div class="col-6 mb-4 text-end">
                            <button type="submit" class="btn btn-primary">Save changes<i
                                    class="material-icons right"></i></button>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



@endsection

