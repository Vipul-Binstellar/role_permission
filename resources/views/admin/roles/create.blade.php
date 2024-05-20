@extends('layouts.app')


    @section('content')
    <div class="content-wrapper">
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">
            <div class="flex p-2">
                <a href="{{ route('roles.index')}}" class="px-4 py-2 btn btn-primary">Back</a>
            </div>
         <div class="flex flex-col">
            <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                  <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700"> Role name </label>
                    <div class="mt-1">
                      <input type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6 pt-5">
                    <button type="submit" onclick="createRole(event)" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Create</button>
                  </div>
                </form>
              </div>
         </div>
        </div>
    </div>
    </div>

    @endsection
