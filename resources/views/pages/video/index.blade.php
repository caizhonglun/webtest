@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1 class="panel-title">影音宣告</h1>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>標題</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <a target="_blank" href="{{ asset($item->path) }}">{{ $item->title }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $items->links() }}
    </div>
</div>
@endsection