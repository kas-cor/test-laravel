@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ajax_content_js">
                <figure class="text-center">
                    <blockquote class="blockquote">
                        <p class="fw-bold">Баланс: {{ Auth::user()->getSum() }}</p>
                    </blockquote>
                </figure>

                <div class="card">
                    <div class="card-header">Последние 5 операций</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Описание</th>
                                <th scope="col" style="width: 150px">Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($operations->count())
                                @foreach($operations as $operation)
                                    <tr>
                                        <th scope="row">{{ $operation->id }}</th>
                                        <td>{{ $operation->sum }}</td>
                                        <td>{{ $operation->description }}</td>
                                        <td>{{ $operation->created_at->format('d.m.Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function ajax_content_loader(selector) {
                window.setTimeout(function () {
                    $.get(location.href, res => {
                        $(selector).html($(res).find(selector).html());
                        ajax_content_loader(selector);
                    });
                }, 1000);
            }

            ajax_content_loader(".ajax_content_js");
        });
    </script>
@endsection
