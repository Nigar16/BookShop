@extends('layouts.master')
@section('title',"Category Add")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Kateqoriya əlavə etmə səhifəsi</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Məhsullar</li>
                            <li class="breadcrumb-item active" aria-current="page">Kateqoriya əlavə etmə səhifəsi</li>
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
                    <form action="{{ route('categoriesAddPost') }}" method="POST" >
                        @csrf
                        <!-- Basic Elements -->
                        <div class="row push">
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="name">Kateqoriya Adı</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Kateqoriya adı daxil edin..." />
                                </div>
                                <div class="form-group">
                                    <label for="main_category">Əsas kateqoriya</label>
                                    <select class="form-control" name="main_category" id="main_category">
                                        <option value="" selected="selected" disabled="disabled">
                                            Əsas kateqoriya varsa, daxil edin
                                        </option>
                                        @foreach($main_categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-outline-primary">Əlavə et</button>
                            </div>
                        </div>
                        <!-- END Basic Elements -->

                    </form>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
