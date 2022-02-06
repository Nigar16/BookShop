@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('error_pass'))
    <div class="alert alert-danger">
        <p>Cari şifrə yanlış daxil edilmişdir!</p>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        <p>Gözlənilməyən bir xəta baş verdi!</p>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        <p>Əməliyyat uğurla icra edildi!</p>
    </div>
@endif
@if(session('error_status'))
    <div class="alert alert-danger">
        <p>Əsas kateqoriya deaktivdir!</p>
    </div>
@endif
@if(session('error_category'))
    <div class="alert alert-danger">
        <p>Əsas kateqoriyası silindiyinə görə aktiv oluna bilməz!</p>
    </div>
@endif
