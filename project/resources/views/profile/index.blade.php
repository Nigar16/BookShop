@extends('layouts.master')
@section('title',"My profile")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-image" style="background-image: url({{ asset('assets/media/photos/photo17@2x.jpg') }});">
            <div class="bg-black-75">
                <div class="content content-full">
                    <div class="py-5 text-center">
                        <a class="img-link" href="#">
                            <img class="img-avatar img-avatar96 img-avatar-thumb"
                                 src="{{ asset(\Illuminate\Support\Facades\Auth::user()->img) }}" alt="">
                        </a>
                        <h1 class="font-w700 my-2 text-white">Mənim Profilim</h1>
                        <h2 class="h4 font-w700 text-white-75">
                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                        </h2>
                        <a class="btn btn-hero-dark" href="{{ route('index') }}">
                            <i class="fa fa-fw fa-arrow-left"></i> Əsas səhifəyə qayıt
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content content-full content-boxed">
            <div class="block block-rounded">
                <div class="block-content">
                    <form action="#" method="POST" enctype="multipart/form-data">
                    @include('layouts.errors')
                    @csrf
                    <!-- User profile -->
                        <h2 class="content-heading pt-0">
                            <i class="fa fa-fw fa-user-circle text-muted mr-1"></i>Məlumatlarım
                        </h2>
                        <div class="row push">
                            <div class="col-lg-4 col-xl-4" style="margin: auto">
                                <div class="form-group">
                                    <label for="dm-profile-edit-username">Ad Soyad</label>
                                    <input type="text" class="form-control" id="dm-profile-edit-username"
                                           disabled="disabled"
                                           value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="dm-profile-edit-name">Email</label>
                                    <input type="text" class="form-control" id="dm-profile-edit-name"
                                           disabled="disabled"
                                           value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                                </div>
                                <div class="form-group">
                                    <label>Your Avatar</label>
                                    <div class="push">
                                        <img class="img-avatar"
                                             src="{{ asset(\Illuminate\Support\Facades\Auth::user()->img) }}" alt="">
                                    </div>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                               id="dm-profile-edit-avatar" name="image">
                                        <label class="custom-file-label" for="dm-profile-edit-avatar">Profil Şəklini
                                            dəyiş</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END User profile -->

                        <!-- Change Password -->
                        <h2 class="content-heading pt-0">
                            <i class="fa fa-fw fa-asterisk text-muted mr-1"></i> Şifrəm
                        </h2>
                        <div class="row push">
                            <div class="col-lg-4 col-xl-4" style="margin: auto">
                                <div class="form-group">
                                    <label for="dm-profile-edit-password">Cari şifrə</label>
                                    <input type="password" class="form-control" id="dm-profile-edit-password"
                                           name="current_password">
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="dm-profile-edit-password-new">Yeni şifrə</label>
                                        <input type="password" class="form-control" id="dm-profile-edit-password-new"
                                               name="new_password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="dm-profile-edit-password-new-confirm">Yeni şifrə təkrar</label>
                                        <input type="password" class="form-control"
                                               id="dm-profile-edit-password-new-confirm" name="new_password_confirm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Change Password -->

                        <!-- Submit -->
                        <div class="row push">
                            <div class="col-lg-8 col-xl-5 offset-lg-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="fa fa-check-circle mr-1"></i> Yenilə
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- END Submit -->
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
