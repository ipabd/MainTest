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
                <div class="col-md-10">
                    <div style="width: 60%" id="tab">
                        <label for="title">{{$product->NAME}}</label>
                        <table style="font-size: 11px;color: #FFFFFF;">
                            <tbody style="font-size: 9px;line-height: 11px;">
                            <tr>
                                <td>АРТИКУЛ</td>
                                <td>{{ $product->ARTICLE }}</td>
                            </tr>
                            <tr>
                                <td>СТАТУС</td>
                                <td>{{ $product->STATUS }}</td>
                            </tr>
                            <tr>
                                <td>НАЗВАНИЕ</td>
                                <td>{{ $product->NAME }}</td>
                            </tr>
                            @if (!empty($data))
                                <tr>
                                    <td>АТРИБУТЫ</td>
                                    <td>

                                        <div id="atrib">
                                            <table style="font-size: 9px;color: #FFFFFF; ">
                                                @foreach($data as $dat)
                                                    <tr>
                                                        <td style="border: none;">
                                                            {{ $dat[0] }} {{ $dat[1] }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>

                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-2  vert pull-right">
                    <a title="Редактировать" href="{{ route('prod.edit', ['prod' => $product->id]) }}"><span
                                class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                    <a id="destr" title="Удалить"><span class="glyphicon glyphicon-remove"></span></a>
                    <form id='forud' action="{{  route('prod.destroy', ['prod' => $product->id]) }}" method="post"
                          class="float-left">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(function () {
            $("#destr").click(function () {
                smoke.confirm("Подтвердите удаление", function (result) {
                    if (result === true) $("#forud").submit();
                });
            });
        });
    </script>
@endsection
