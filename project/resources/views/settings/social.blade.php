@extends('layouts.master')
@section('title',"Settings | Contact")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Sosial şəbəkələr</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Nizamlamalar</li>
                            <li class="breadcrumb-item active" aria-current="page">Sosial</li>
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
                    <form action="{{ route('socialPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Basic Elements -->
                        <div class="row push">
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="instagram">Instagram linki</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                           value="{{ $data[0]->instagram }}"/>instagram
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook linki</label>
                                    <input type="text" class="form-control" id="facebook"
                                           name="facebook" value="{{ $data[0]->facebook }}"/>
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
