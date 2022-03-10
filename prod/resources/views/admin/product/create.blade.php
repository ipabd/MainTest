@extends('layouts.layout')
@section('content')
    <div class="row row-flex row-flex-wrap">
        <div class="col-md-2 " style="background: #374050;">
            <table>
                <tr>
                    <td style="font-size: 12px;
                            line-height: 11px;color: rgba(255, 255, 255, 0.7);">&nbsp;&nbsp;&nbsp;Продукты
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-md-10  "
             style="background:#374050;color: #FFFFFF;font-size: 20px; padding-left: 0px;padding-top: 20px">
            <div class="container">
                <div class="col-md-11">
                    <div style="width: 70%" id="atrib">
                        <label for="title">Добавить продукт</label>

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
                              action="{{ route('prod.store') }}">
                            @csrf

                            <div class="form-group">
                                <label style="font-size: 9px;line-height: 11px;color: #FFFFFF;">Артикул</label>
                                <input id="ARTICLE" type="text"
                                       class="form-control @error('ARTICLE') is-invalid @enderror" name="ARTICLE"
                                       value="{{ old('ARTICLE') }}" required autocomplete="ARTICLE" autofocus>
                                @error('ARTICLE')
                                <span> <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label style="font-size: 9px;line-height: 11px;color: #FFFFFF;">Название</label>
                                <input id="NAME" type="text" class="form-control @error('NAME') is-invalid @enderror"
                                       name="NAME"
                                       value="{{ old('NAME') }}" required autocomplete="NAME" autofocus>
                                @error('NAME')
                                <span> <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label style="font-size: 9px;line-height: 11px;color: #FFFFFF;">Статус</label>
                                <select class="form-control @error('STATUS') is-invalid @enderror" id="STATUS"
                                        name="STATUS">
                                    @foreach($status as $k => $v)
                                        <option value="{{ $v->STATUS }}" selected>{{ $v->NAME }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Атрибуты</label>
                                <table style="font-size: 9px;color: #FFFFFF;" id="dataTable"></table>
                                <a type="button" name="add" id="add" style="font-size: 9px;color: #0FC5FF;">
                                    <span class="glyphicon-plus"></span>Добавить атрибут</a>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block"
                                            style="border-color: #0FC5FF;width:136px;background: #0FC5FF;">Добавить
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-1  vert pull-right">
                    <a title="Выход." href="{{ route('home')}}"><span class="glyphicon glyphicon-remove"></span></a>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        var i = 0;
        $("#add").click(function () {
            ++i;
            $("#dataTable").append(
                '<tr id="tr' + i + '">' +
                '<td>Название</td>' +
                '<td>Значение</td>' +
                '</tr>'
                +
                '<tr >' +
                '<td><input type="text" name="NAM[' + i + ']" ' +
                ' class="form-control" /></td>' +
                '<td><input type="text" name="ZN[' + i + ']" ' +
                ' class="form-control" /></td>' +
                '<td><a type="button" data-i="' + i + '" id="del"><span class="glyphicon glyphicon-remove"></span></a></td>' +
                '</tr>');
        });
        $(document).on('click', '#del', function () {
            let n = $(this).data('i');
            $(this).parents('tr').remove();
            $('#tr' + n).remove();
        });
    </script>
@endsection
