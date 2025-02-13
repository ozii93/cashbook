@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <center class="m-t-30">
                                        <img
                                            src="../assets/images/users/5.jpg"
                                            class="img-circle"
                                            width="150" />
                                        <h4 class="card-title m-t-10">
                                            {{ Auth::user()->name }}
                                        </h4>
                                        <h6 class="card-subtitle">
                                            {{$cabang->Name}} <br>

                                        </h6>

                                    </center>
                                </div>
                                <div>
                                    <hr />
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">Email address
                                    </small>
                                    <h6> {{ Auth::user()->email }}</h6>
                                    <small class="text-muted p-t-30 db">Phone</small>
                                    <h6></h6>
                                    <small class="text-muted p-t-30 db">Address</small>
                                    <h6>
                                        {{$cabang->Address}}
                                    </h6>


                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-8 col-xlg-9 col-md-7">
                            <div class="card">
                                <!-- Nav tabs -->
                                <ul
                                    class="nav nav-tabs profile-tab"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link active"
                                            data-toggle="tab"
                                            href="#home"
                                            role="tab">Profile</a>
                                    </li>

                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div
                                        class="tab-pane active"
                                        id="home"
                                        role="tabpanel">
                                        <div class="card-body">

                                            <form method="post" action="{{ route('password.update') }}" class="form-horizontal form-material">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label class="col-md-12">Current Password</label>
                                                    <div class="col-md-12">
                                                        <input
                                                            id="update_password_current_password" name="current_password" type="password"
                                                            class="form-control form-control-line" />
                                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12">New Password</label>
                                                    <div class="col-md-12">
                                                        <input
                                                            id="update_password_password" name="password" type="password"
                                                            class="form-control form-control-line" />
                                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-md-12">Confirm Password</label>
                                                    <div class="col-md-12">
                                                        <input
                                                            id="update_password_password_confirmation" name="password_confirmation" type="password"
                                                            class="form-control form-control-line" />
                                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button
                                                            class="btn btn-success">
                                                            Update Profile
                                                        </button>
                                                        @if (session('status') === 'password-updated')
                                                        <p
                                                            x-data="{ show: true }"
                                                            x-show="show"
                                                            x-transition
                                                            x-init="setTimeout(() => show = false, 2000)"
                                                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                                        @endif
                                                    </div>
                                                </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Column -->
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