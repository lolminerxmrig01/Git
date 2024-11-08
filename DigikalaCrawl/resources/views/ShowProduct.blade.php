@extends ('layout')

@section('content')
    <!-- Product section-->

    <div class="container">
        <div class="row">
            <div class="col-md-3 seller">
                <h6>قیمت مصرف کننده</h6>
                <h4><span>  {{  $product->getPrice() }} </span>
                    <span>{{ 'تومان' }}</span></h4>

            </div>
            <div class="col-md-5">
                <h1 class="title fw-bolder">{{ $product->getTitle() }}</h1>
                <hr>
            </div>
            <div class="col-md-4">
                <img class="card-img-top mb-5 mb-md-0" src="{{ $product->getImage() }}" alt="..."/>
            </div>

        </div>
    </div>


@endsection
