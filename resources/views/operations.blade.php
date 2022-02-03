@extends('layouts.app')

@section('title', 'История операций')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="row g-3 mb-3" method="GET">
                    <input type="hidden" name="sort" value="{{ Request::query('sort') }}"/>
                    <input type="hidden" name="direction" value="{{ Request::query('direction') }}"/>
                    <div class="col-10">
                        <label for="keywords" class="visually-hidden">Ключевые слова</label>
                        <input type="text" name="keywords" value="{{ Request::query('keywords') }}" class="form-control" placeholder="Поиск по описанию..."/>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary w-100">Найти</button>
                    </div>
                </form>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">@sortablelink('id', 'ID')</th>
                        <th scope="col">@sortablelink('sum', 'Сумма')</th>
                        <th scope="col">@sortablelink('description', 'Описание')</th>
                        <th scope="col" style="width: 150px">@sortablelink('created_at', 'Дата')</th>
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

                <div class="d-flex justify-content-center">
                    {!! $operations->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
