@extends('layouts.master')
@section('title',"Settings | Contact")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Əlaqə</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Nizamlamalar</li>
                            <li class="breadcrumb-item active" aria-current="page">Əlaqə</li>
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
                    <form action="{{ route('contactPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Basic Elements -->
                        <div class="row push">
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="phone_number_1">Əlaqə nömrəsi №1</label>
                                    <input type="phone" class="form-control" id="phone_number_1" name="phone_number_1"
                                           value="{{ $data[0]->phone1 }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number_2">Əlaqə nömrəsi №2</label>
                                    <input type="phone" class="form-control" id="phone_number_2"
                                           name="phone_number_2" value="{{ $data[0]->phone2 }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="address">Ünvan</label>
                                    <input type="text" class="form-control" id="address"
                                           name="address" value="{{ $data[0]->address }}"/>
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
