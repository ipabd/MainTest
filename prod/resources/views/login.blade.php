@extends('layouts.layout')
@section('content')
    <div class="row row-flex row-flex-wrap">
        <div class="col-lg-2 " style="background: #374050;">
            <table>
                <tr>
                    <td style="font-size: 12px;
                            line-height: 11px;color: rgba(255, 255, 255, 0.7);">&nbsp;Продукты
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

            <form id="contact-form-contact-us" class="contact-form" method="POST" action="{{ route('login') }}">
                @csrf
                <table>
                    <tr>
                        <td><label style="color: #cbd5e0;padding-right: 10px">Логин</label></td>
                        <td>
                            <div class="form-group">
                                <input type="text" name="login" id="login" class="required" value=""/>
                                @if ($errors->has('login'))
                                    <strong>{{ $errors->first('login') }}</strong>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label style="color: #cbd5e0;padding-right: 10px">Пароль</label></td>
                        <td>
                            <div class="form-group">
                                <input type="password" name="password" class="required" value=""/>
                                @if ($errors->has('password'))
                                    <span class="help-block">
				                <strong>{{ $errors->first('password') }}</strong>
				               </span>
                                @endif
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


