@extends('layouts.master')
@section('title',"Users List")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">İstifadəçilər</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">İstifadəçilər</li>
                            <li class="breadcrumb-item active" aria-current="page">Siyahı</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Full -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    @include('layouts.errors')
                </div>
                <div class="block-content block-content-full">
                    <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#add">Əlavə Et</button>
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Ad Soyad</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                            <th style="width: 15%;">Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->status=="1")
                                        <span class="badge badge-success">Aktiv</span>
                                    @elseif($user->status=="0")
                                        <span class="badge badge-danger">Deaktiv</span>
                                    @endif
                                </td>
                                <td>
                                    <button onclick="UserUpdateView({{ $user->id }})" class="btn btn-outline-info">Redaktə Et</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
        <!-- END Page Content -->
    </main>

    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">İstifadəçi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('userEdit') }}">
                        @csrf
                        <input type="hidden" name="edit_id" id="edit_id" />
                        <div class="form-group">
                            <label for="edit_name" class="col-form-label">Ad Soyad:</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="edit_email" id="edit_email">
                        </div>
                        <div class="form-group">
                            <label for="edit_position" class="col-form-label">Vəzifə:</label>
                            <input type="text" class="form-control" name="edit_position" id="edit_position">
                        </div>
                        <div class="form-group">
                            <label for="edit_roles" class="col-form-label">Sistemdəki rolu:</label>
                            <select name="edit_roles" id="edit_roles" class="form-control">
                                @foreach($roles as $role)
                                    @continue($role==1)
                                    <option value="{{ $role }}">{{ \App\Http\Controllers\General\GeneralController::getRoleWithKey($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_status" class="col-form-label">Status:</label>
                            <select name="edit_status" id="edit_status" class="form-control">
                                <option value="1">Aktiv</option>
                                <option value="0">Deaktiv</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" name="edit_password" placeholder="Şifrə" id="edit_password">
                            </div>
                            <div class="form-group col-md-3">
                                <button type="button" onclick="makePassword()" class="btn btn-outline-danger">Şifrə qur</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                            <button type="submit" class="btn btn-primary">Redaktə Et</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">İstifadəçi əlavəsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('userAdd') }}">
                        @csrf
                        <input type="hidden" name="add_id" id="add_id" />
                        <div class="form-group">
                            <label for="add_name" class="col-form-label">Ad Soyad:</label>
                            <input type="text" class="form-control" name="add_name" id="add_name">
                        </div>
                        <div class="form-group">
                            <label for="add_email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="add_email" id="add_email">
                        </div>
                        <div class="form-group">
                            <label for="add_position" class="col-form-label">Vəzifə:</label>
                            <input type="text" class="form-control" name="add_position" id="add_position">
                        </div>
                        <div class="form-group">
                            <label for="add_roles" class="col-form-label">Sistemdəki rolu:</label>
                            <select name="add_roles" id="add_roles" class="form-control">
                                @foreach($roles as $role)
                                    @continue($role!=2)
                                    <option value="{{ $role }}">{{ \App\Http\Controllers\General\GeneralController::getRoleWithKey($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add_status" class="col-form-label">Status:</label>
                            <select name="add_status" id="add_status" class="form-control">
                                <option value="1">Aktiv</option>
                                <option value="0">Deaktiv</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" name="add_password" placeholder="Şifrə" id="add_password">
                            </div>
                            <div class="form-group col-md-3">
                                <button type="button" onclick="makePassword_add()" class="btn btn-outline-danger">Şifrə qur</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                            <button type="submit" class="btn btn-primary">Əlavə Et</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}" >
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/general.js') }}"></script>
@endsection
