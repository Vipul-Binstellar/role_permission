 @extends('layouts.app')


    @section('content')
    <div class="content-wrapper">

    {{-- <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto  sm:px-6 lg:px-8 rounded bg-white pb-6 pt-2">
            <div class="flex p-2 pt-3">
                <a href="{{ route('roles.index')}}" class="px-4 py-2 btn btn-primary">Back</a>
            </div>
         <div class="flex flex-col bg-slate-100 rounded pl-4 pb-3">
            <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-6">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                  <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700"> Role name </label>
                    <div class="mt-1">
                      <input type="text" id="name" name="name" value="{{$role->name}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6 pt-3">
                    <button type="submit" onclick="editRole(event)" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Update</button>
                  </div>
                </form>
              </div>
         </div>

         <div class="mt-6 pl-4 bg-slate-100 rounded pb-3">
            <h2 class="text-2xl font-semibold pt-2"> Permission</h2>
            <div class="mt-4 p-2">
                @if ($role->permissions)
                @foreach ($role->permissions as $role_permission)
                <form  class="px-4 py-2 btn btn-danger" method="POST" action="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id])}}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('delete')
                    <button type="submit">{{$role_permission->name}}</button>
                </form>
                @endforeach
                @endif
            </div>
            <div class="w-1/2 mt-6">
                <form method="POST" action="{{ route('roles.permissions', $role->id) }}">
                    @csrf
                  <div class="sm:col-span-6">
                    <label for="permission"
                                    class="block text-sm font-medium text-gray-700">Permission</label>
                                <select id="permission" name="permission" autocomplete="permission-name"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6 pt-3">
                    <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
                  </div>
                </form>
            </div>




         </div>
        </div>
    </div> --}}

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
                            <input type="hidden" name="id" value="{{ $role->id }}">

                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $role->name }}" placeholder="name" required />
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
                                                                        {{ $create }} />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][read]"
                                                                        {{ $read }} />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][update]"
                                                                        {{ $update }} />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][delete]"
                                                                        {{ $delete }} />
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
                                                                        name="permission[{{ $key }}][create]" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][read]" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][update]" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][delete]" />
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
                            <div class="col-6 mb-4 text-end">
                                <button type="submit" class="btn btn-primary">Save changes<i
                                        class="material-icons right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>



    @endsection

