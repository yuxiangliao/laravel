<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <style>
            html, body {
                height: 100%;
            }

            body {
                font-size: 30px;
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                {{--@if($data['score']<60)--}}
                    {{--不及格--}}
                    {{--@else--}}
                    {{--及格--}}
                    {{--@endif--}}

                {{--@unless($data['score']>60)--}}
                    {{--不及格--}}
                    {{--@endunless--}}
                {{--@for($i=0;$i<=$data['num'];$i++)--}}
                    {{--{{$i}}<br/>--}}
                    {{--@endfor--}}
                {{--@foreach($data['article'] as $v)--}}
                    {{--{{$v}}<br/>--}}
                    {{--@endforeach--}}
                {{--@forelse($data['news'] as $v)--}}
                {{--{{$v}}<br/>--}}
                    {{--@empty--}}
                    {{--没有数据--}}
                {{--@endforelse--}}
                @foreach($data['article'] as $k=>$v)
                    @if($k>1)
                    {{$k}}=>{{$v}}<br/>
                    @endif
                @endforeach
            </div>
        </div>
    </body>
</html>
