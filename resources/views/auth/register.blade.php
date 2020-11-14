@extends('layouts.site')

@section('content')
        <div class="container no-index">
            <div class="row">
                <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="main">
                        <div class="page-header">
                            <h1 class="page-title hidden-xs-up">
                                إنشاء حساب
                            </h1>
                        </div>
                        <section id="content" class="page-content">
                            <section class="register-form">
                                <p>لديك حساب بالفعل؟ <a href="{{route("login")}}">سجل الدخول بدلا من ذلك!</a></p>
                                <form action="{{route("register")}}" id="customer-form" class="js-customer-form" method="post">
                                    @csrf
                                    <section>

                                        <div class="form-group row no-gutters">
                                            <label class="col-md-2 form-control-label mb-xs-5 required">
                                                الاسم  :
                                            </label>
                                            <div class="col-md-6">

                                                <input   id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>



                                            </div>

                                            <div class="col-md-4 form-control-comment right">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row no-gutters">
                                            <label class="col-md-2 form-control-label mb-xs-5 required">
                                                الموبيل :
                                            </label>
                                            <div class="col-md-6">

                                                <input   id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}"  autocomplete="mobile">



                                            </div>

                                            <div class="col-md-4 form-control-comment right">
                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="form-group row no-gutters">
                                            <label class="col-md-2 form-control-label mb-xs-5 required">
                                                كلمة المرور :
                                            </label>
                                            <div class="col-md-6">

                                                <div class="input-group js-parent-focus">
                                                    <input   id="password" type="password" class="form-control js-child-focus js-visible-password @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                                    <span class="input-group-btn">
            <button class="btn" type="button" data-action="show-password" data-text-show="إظهار" data-text-hide="إخفاء">
              إظهار
            </button>
          </span>
                                                </div>


                                            </div>

                                            <div class="col-md-4 form-control-comment right">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row no-gutters">
                                            <label class="col-md-2 form-control-label mb-xs-5 required">
                                                اعادة كلمة المرور:
                                            </label>
                                            <div class="col-md-6">

                                                <div class="input-group js-parent-focus">
                                                    <input   id="password" type="password" class="form-control js-child-focus js-visible-password @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password">
                                                    <span class="input-group-btn">
            <button class="btn" type="button" data-action="show-password" data-text-show="إظهار" data-text-hide="إخفاء">
              إظهار
            </button>
          </span>
                                                </div>


                                            </div>

                                            <div class="col-md-4 form-control-comment right">
                                            </div>
                                        </div>

                                    </section>


                                    <footer class="form-footer clearfix">
                                        <div class="row no-gutters">
                                            <div class="col-md-10 offset-md-2">
                                                <input type="hidden" name="submitCreate" value="1">

                                                <button class="btn btn-primary form-control-submit mb-20" data-link-action="save-customer" type="submit">
                                                    إنشاء حساب
                                                </button>

                                            </div>
                                        </div>
                                    </footer>


                                </form>


                            </section>


                        </section>






                    </div>


                </div>
            </div>
        </div>




    {{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
--}}
@endsection
