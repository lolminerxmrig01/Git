@extends ('layout')


@section('content')
    <div class="container">
        <div class="row justify-content-md-center index">
            <div class="col-md-6 ">
                {!! Form::open(array('url' => '/ShowProduct/')) !!}
                <div class="form-group">
                    <label for="exampleInputEmail1">شناسه محصول را وارد نمایید</label>
                    <input type="text" class="form-control" placeholder="" name="product">
                    <small id="emailHelp" class="form-text text-muted">شناسه محصول به این فرمت : dkp-2222 </small>
                </div>
                <button type="submit" class="btn btn-primary">جستجو</button>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection

