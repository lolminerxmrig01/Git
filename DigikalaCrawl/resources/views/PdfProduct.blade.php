<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Digikala</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <style>
        .title {
            /*font-family: vazir;*/
            text-align: right;
            direction: rtl;
            padding-right: 20px;
            font-size: 20px;
        }

        .image {
            max-width: 500px;
        }

        .price {
            direction: rtl;
            font-size: 23px;
            /*font-family: Vazir;*/
            padding-bottom: 18px;
        }

    </style>
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="upper p-4">
                    <div class="text-center">
                        <img src="https://www.digikala.com/static/files/bc60cf05.svg" class="center-block">
                    </div>

                </div>
                <hr>
                <div class="title">
                    {{--                    {{ $title }}--}}
                    {{ $product->getTitle() }}
                </div>


                <hr>
                <div class="text-center">
                    <img class="card-img-top mb-5 mb-md-0 image"
                         src="{{ $product->getImage() }}" alt="..."/>
                </div>
                <hr>
                <div class="transaction mt-2 price">
                    <div class="text-center">
                        قیمت : {{ $product->getPrice() }} تومان
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
