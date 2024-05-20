@extends('layouts.app')
@section('title','Users')
@section('content')
<div class="content-wrapper">

  <div class="py-12 w-full">
    <div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">
        {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3"> --}}

            <div class="card-body">
                <div class="flex justify-end p-2">
                    <a href="{{ route('users.create') }}" class="px-4 py-2 btn btn-primary">Create user</a>
                </div>

            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col-4">ID</th>
                        <th scope="col-4">Name</th>
                        <th scope="col-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td scope="row">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <div class="flex">
                            <div class="space-x-2">
                        <a href="{{ route('users.edit', $user->id)}}" class="px-4 py-2 btn btn-primary">Edit</a>
                        <form  class="px-4 py-2 btn btn-danger" method="get" action="{{ route('users.destroy', $user->id)}}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('delete')
                        <button class="btn-danger" style="border: none" type="submit">Delete</button>
                    </form>
                    </div>
                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>
</div>
@endsection
<!-- DataTables -->
@section('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(function () {
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

  });
</script>
@endsection


