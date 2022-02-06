@extends('layouts.master')
@section('title',"Product Add")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Məhsul əlavə etmə
                        səhifəsi</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Məhsullar</li>
                            <li class="breadcrumb-item active" aria-current="page">Məhsul əlavə etmə səhifəsi</li>
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
                    <form action="{{ route('ProductAddPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Basic Elements -->
                        <div class="row push">
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="category">Kateqoriya</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="" disabled="disabled" selected="selected">Seçim edin</option>
                                        @foreach($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @if($category->SubCategoryGet($category->id))
                                                    @foreach($category->SubCategoryGet($category->id) as $subcategory)
                                                        <option
                                                            value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled="disabled">Alt kateqoriya yoxdur</option>
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Məhsulun Adı</label>
                                    <input type="text" class="form-control" id="name" value="{{old("name")}}" name="name"
                                           placeholder="Məhsulun adını daxil edin..."/>
                                </div>
                                <div class="form-group">
                                    <label for="author">Müəllif</label>
                                    <input type="text" class="form-control" id="author" value="{{old("author")}}" name="author"
                                           placeholder="Müəllif adını daxil edin..."/>
                                </div>
                                <div class="form-group">
                                    <label for="about">Məzmun</label>
                                    <textarea id="about" name="about" class="js-summernote">{{old("about")}}</textarea>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                           id="dm-profile-edit-avatar" name="image">
                                    <label class="custom-file-label" for="dm-profile-edit-avatar">Şəkil Seç</label>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="price">Qiymət</label>
                                    <input type="number" min="0" step="0.01" class="form-control" value="{{old("price")}}" required="required" id="price" name="price" />
                                </div>

                                <button class="btn btn-outline-primary">Əlavə et</button>
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
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>jQuery(function () { Dashmix.helpers(['summernote']); });</script>
@endsection
