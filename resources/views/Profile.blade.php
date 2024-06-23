<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- CSS DAN JS -->
    <link href={{ asset('assets/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/stylebelanja/bootstrap.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/stylebelanja/costumstyle.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/stylebelanja/responsive.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/stylebelanja/jquery.mCustomScrollbar.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/bootstrap/scss/_alert.scss') }}>
</head>

<body>
    <div class="banner_bg_main">
        <!-- header top section start -->
        <div class="container">
            <div class="header_section_top">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="{{route('index')}}"><img src="{{ asset('assets/img/logobrand.png') }}" alt="Logo Brand" width="200px"></a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Data Pribadi') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Foto Profil -->
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset(Auth::user()->folder. '/' .Auth::user()->foto) }}" alt="Foto Profil" class="img-thumbnail" style="max-width: 150px;">
                                    </div>

                                    <!-- Unggah Foto Profil -->
                                    <div class="mb-3">
                                        <label for="foto" class="form-label"></label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                        @error('foto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Nama -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? Auth::user()->email }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                                        <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') ?? Auth::user()->alamat }}" required>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div class="mb-3">
                                        <label for="tanggallahir" class="form-label">{{ __('Tanggal Lahir') }}</label>
                                        <input id="tanggallahir" type="date" class="form-control @error('tanggallahir') is-invalid @enderror" name="tanggallahir" value="{{ old('tanggallahir') ?? Auth::user()->tanggallahir }}" required>
                                        @error('tanggallahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="mb-3">
                                        <label for="jeniskelamin" class="form-label">{{ __('Jenis Kelamin') }}</label>
                                        <select id="jeniskelamin" class="form-select @error('jeniskelamin') is-invalid @enderror" name="jeniskelamin" required>
                                            <option value="L" {{ (old('jeniskelamin') ?? Auth::user()->jeniskelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ (old('jeniskelamin') ?? Auth::user()->jeniskelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jeniskelamin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="mb-0">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update Profile') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- error section end -->
        </div>
    </div>
</body>

</html>