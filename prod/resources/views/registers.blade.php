@extends('layouts.layout')
@section('content')
    <div class="row row-flex row-flex-wrap">
        <div class="col-lg-2 " style="background: #374050;">
            <table>
                <tr>
                    <td style="font-size: 12px;
                            line-height: 11px;color: rgba(255, 255, 255, 0.7);">&nbsp;&nbsp;&nbsp;Продукты
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-10 "
             style="background:#374050;color: #FFFFFF;font-size: 20px; padding-left: 0px;padding-top: 20px">

            @if ($errors->any())
                <div class="row">
                    @foreach ($errors->all() as $error)
                        <script>
                            mainwin("{{ $error }}");
                        </script>
                    @endforeach
                </div>
            @endif


            <form id="contact-form-contact-us" class="contact-form" method="POST"
                  action="{{ route('register.store') }}">
                @csrf
                <table>
                    <tr>
                        <td><label style="color: #cbd5e0;padding-right: 10px">Логин</label></td>
                        <td>
                            <div class="form-group">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror"
                                       name="login"
                                       value="{{ old('login') }}" required autocomplete="login" autofocus>
                                @error('login')
                                <span> <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><label style="color: #cbd5e0;padding-right: 10px">email</label></td>
                        <td>
                            <div class="form-group">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><label style="color: #cbd5e0;padding-right: 10px">Пароль</label></td>
                        <td>
                            <div class="form-group">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       value="{{ old('password') }}" required autocomplete="password" autofocus>
                                @error('password')
                                <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><label style="color: #cbd5e0;padding-right: 10px">Подтверждение пароля</label></td>
                        <td>
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-block"
                                style="border-color: #0FC5FF;width:136px;background: #0FC5FF;">Отправить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


