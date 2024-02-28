@extends('layouts.app')

@section('content')
<div class="container-fluid bg-gradient-success bg-register">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                                </div>
                                
                                <form class="user" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Lengkap . . ." required autocomplete="name" autofocus>

                                    </div>

                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan Email . . ." required autocomplete="email">

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password" required autocomplete="new-password">
                                           
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password">
                                        </div>
                                    
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('login')}}">Sudah memiliki akun? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection