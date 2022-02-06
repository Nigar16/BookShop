@extends('layouts.master')
@section('title',"Settings | General")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Ümumi Nizamlamalar</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Nizamlamalar</li>
                            <li class="breadcrumb-item active" aria-current="page">Ümumi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Elements -->
            <div class="block block-rounded">
                @include('layouts.errors')
                <div class="block-content">
                    <form action="{{ route('generalPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Basic Elements -->
                        <div class="row push">
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="default_title">Başlıq</label>
                                    <input type="text" class="form-control" id="default_title" name="default_title"
                                           value="{{ $data[0]->default_title }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="default_description">Açıqlama</label>
                                    <input type="text" class="form-control" id="default_description"
                                           name="default_description" value="{{ $data[0]->default_description }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="default_keywords">Açar Sözlər</label>
                                    <input type="text" class="form-control" id="default_keywords"
                                           name="default_keywords" value="{{ $data[0]->default_keywords }}"/>
                                </div>
                                <button class="btn btn-outline-primary">Dəyişdir</button>
                            </div>
                        </div>
                        <!-- END Basic Elements -->

                    </form>
                </div>
            </div>
            <!-- END Elements -->

            <!-- Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    <form action="{{ route('logoChange') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Basic Elements -->
                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <label for="default_title">Cari Logo (Light)</label> <br/>
                                    <img style="height: 150px; width: auto;" src="{{ asset($data[0]->logo_light) }}"
                                         alt=""/>
                                </div>
                                <div class="col-lg-6 col-xl-6">
                                    <label for="default_title">Cari Logo (Dark)</label> <br/>
                                    <img style="height: 150px; width: auto;" src="{{ asset($data[0]->logo_dark) }}"
                                         alt=""/>
                                </div>
                            </div>

                        <div class="row push mt-2">
                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label for="logo_light">Logo (Light)</label>
                                    <input type="file" class="form-control" required="required" id="logo_light" name="logo_light" />
                                </div>
                                <div class="form-group">
                                    <label for="logo_dark">Logo (Dark)</label>
                                    <input type="file" class="form-control" required="required" id="logo_dark" name="logo_dark" />
                                </div>
                                <button class="btn btn-outline-primary">Dəyişdir</button>
                            </div>
                        </div>
                <!-- END Basic Elements -->

                </form>
            </div>
        </div>
        <!-- END Elements -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
