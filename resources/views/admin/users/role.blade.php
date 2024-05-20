@extends('layouts.app')

@section('content')
    @section('title','Role & Permission')

    <div class="content-wrapper">

    <div class="py-12 w-full">

    {{-- <div class="row"> --}}
        <div class="col-xl">
        <div class="card mb-4" style="display: contents">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4"> --}}
                <div class="flex p-2">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 bg-primary text-slate-100 rounded-md">Back</a>
                </div>
                <div class="flex flex-col p-2 bg-slate-100">
                    <div>User Name: {{ $user->name }}</div>
                    <div>User Email: {{ $user->email }}</div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <div class="form-floating form-floating-outline mb-4">
                                <label for="name">User</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $user->name }}" placeholder="name" required />
                                @error('name')
                                    <small class="red-text ml-10" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                    <div class="sm:col-span-6 pt-5">
                        <button type="submit"
                            class="px-4 py-2 btn btn-success rounded-md">Update</button>
                    </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
</div>
    @endsection
