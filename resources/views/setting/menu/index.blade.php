@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Menu</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Setting</a>
                </li>
                <li class="breadcrumb-item active">Menu</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <a href="{{ route('menu.create') }}" type="button" id="tambah"
                            class="btn waves-effect waves-light btn-rounded btn-success">Create</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped stylish-table" style="color: white;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Breadcrumb</th>
                                    <th>URL</th>
                                    <th>Icon</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($header as $header)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td nowrap>
                                        <a href="{{ url('/menu/edit/' . $header->id) }}"
                                            id="btn-edit" class="btn btn-xs btn-primary">
                                            <i class="fa fa-edit" title="Edit Data"></i>
                                        </a>
                                        <!-- <a href="#"
                                            data-id="{{ $header->id }}"
                                            id="btn-delete" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash" title="delete"></i>
                                        </a> -->
                                    </td>
                                    <td>{{ $header->name }}</td>
                                    <td>{{ $header->parent_name }}</td>
                                    <td>{{ $header->breadcrumb }}</td>
                                    <td>{{ $header->url }}</td>
                                    <td>{{ $header->icon }}</td>
                                    <td>{{ $header->level }}</td>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection
@push('after-script')
@vite(['resources/js/datatables.js', 'resources/js/script.js'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initDeleteButton('#btn-delete', "{{ url('/menu') }}");
    });
</script>
@endpush