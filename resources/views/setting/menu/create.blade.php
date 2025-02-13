@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <!-- <h3 class="text-themecolor m-b-0 m-t-0">Menu</h3> -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Menu</a>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="color: white;">

                    <form action="{{ route('menu.store') }}" onsubmit="return validateForm()" method="POST"
                        enctype="multipart/form-data" id="form" class="form-material row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control form-control-line" id="name" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Breadcrumb</label>
                            <input type="text" class="form-control form-control-line" id="breadcrumb" name="breadcrumb" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Parrent</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option>

                                </option>
                                @foreach ($data as $a)
                                <option value="{{ $a->id }}">
                                    {{ $a->breadcrumb }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Url</label>
                            <input type="text" class="form-control form-control-line" id="url" name="url" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Icon</label>
                            <input type="text" class="form-control form-control-line" id="icon" name="icon">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Level</label>
                            <select class="form-control" id="level" name="level">
                                <option value="menu">Menu</option>

                                <option value="module">Module</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Active</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="button" class="btn waves-effect waves-light btn-primary" id="btnsubmit">Submit</button>
                            <a type="submit" href="{{ route('menu') }}"
                                class="btn waves-effect waves-light btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection

@push('after-script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $('#btnsubmit').on('click', function(event) {
        event.preventDefault();
        const isFormValid = validateForm();

        if (isFormValid) {
            // Tampilkan popup konfirmasi dengan SweetAlert2
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, jalankan submit form dan disable tombol
                    $(this).prop('disabled', true); // Disable tombol hanya jika confirmed
                    $('body').append('<div class="overlay"><div class="spinner"></div></div>');
                    $('#form').submit();
                }
            });
        }
    });

    function validateForm() {
        var name = document.getElementById("name").value;
        var url = document.getElementById("url").value;

        if (name == "") {
            alert("Name Cannot Be Empty!");
            return false;
        }
        if (url == "") {
            alert("URL Cannot Be Empty!");
            return false;
        }

        return true;
    }

    $('#form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var dataform = new FormData(form);
        var btnsubmit = document.getElementById("btnsubmit");

        // Konfigurasi CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: dataform,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'Please Wait ...',
                    allowOutsideClick: false,
                    confirmButtonText: "Something went wrong",
                    confirmButtonColor: "#ea0a2a",
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })

            },
            success: function(res) {
                if (res.status == 200) {
                    Swal.fire({
                        icon: "success",
                        title: `${res.message}`,
                        timer: 1500,
                    }).then(() => {
                        // Redirect setelah sukses
                        window.location = res.url;
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: `${res.message}`,
                    });
                    btnsubmit.disabled = false; // Enable tombol jika gagal
                }
                Swal.close();

            },
            error: function(error) {
                Swal.close();


                Swal.fire({
                    icon: "error",
                    title: "An error occurred!",
                    text: error.responseJSON?.message || "Something went wrong.",
                });
                btnsubmit.disabled = false; // Enable tombol jika ada error
            }
        });
    });
</script>
@endpush