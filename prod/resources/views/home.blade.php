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
                    <div style="width: 100%" id="tab">
                        <table style="font-size: 11px;color: rgba(255, 255, 255, 0.7);">
                            <thead style="font-size: 9px;line-height: 11px;">
                            <tr>
                                <td></td>
                                <td>АРТИКУЛ</td>
                                <td>НАЗВАНИЕ</td>
                                <td>СТАТУС</td>
                                <td>АТРИБУТЫ</td>
                            </tr>
                            </thead>
                            <tbody>
                            @set($i,0)
                            @foreach($product as $prod)
                                <tr>
                                    <td style="width: 5px; padding-left: 0px">
                                        <a title="Карточка" href="{{ route('product', ['id' => $prod->id]) }}"><span
                                                    class="glyphicon glyphicon-credit-card"></span></a>
                                    </td>
                                    <td>{{ $prod->ARTICLE }}</td>
                                    <td>{{ $prod->NAME }}</td>
                                    <td>{{ $prod->STATUS }}</td>
                                    @if (!empty($data[$i]))
                                        <td>
                                            <div id="atrib">
                                                <table style="font-size: 9px;color: rgba(255, 255, 255, 0.7); ">
                                                    @foreach($data[$i] as $dat)
                                                        <tr>
                                                            <td style="border: none;">
                                                                {{ $dat[0] }}{{ $dat[1] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif

                                </tr>
                            </tbody>
                            @set($i, $i+1)
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="col-md-2  vert pull-right">
                    <a href="{{route('prod.create')}}"
                       class="btn btn-primary"
                       style="border-color: #0FC5FF;width:136px;background: #0FC5FF;">Добавить</a>
                </div>

            </div>
        </div>
    </div>
@endsection