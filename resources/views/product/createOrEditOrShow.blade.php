@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <?php
                    $data =
                    [
                        'method' => $method
                    ]
                ?>
                @include('product/_form', $data)
            </div>
        </div>
    </div>
</div>
@endsection