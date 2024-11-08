<?php
return [
    // سال 99
    // هزینه ارسال از تهران و مراکز استان ها
    "sefarshi" => [
        "tariff" => [
            "500" => [
                "insidePart" => 40480,  // درون استانی
                "edgePart" => 53900, // استان همجوار
                "outsidePart" => 58300 // استان دور
            ] ,
            "1000" => [
                "insidePart" => 53130,
                "edgePart" => 74360,
                "outsidePart" => 80080
            ] ,
            "2000" => [
                "insidePart" => 75900,
                "edgePart" => 96800,
                "outsidePart" => 104500
            ] ,
            "3000" => [
                "insidePart" => 73370,
                "edgePart" => 118800,
                "outsidePart" => 127600
            ] ,
            "5000" => [
                "insidePart" => 73370 , // تا حداکثر 5 کیلوگرم
                "edgePart" => 10000 ,
                "outsidePart" => 10000
            ]
        ] ,
    ] ,

    "maliat" => 0.09 , //درصد مالیات
    "bime" => 8000 , // بیمه تا مبلغ 8 میلیون ریال
    "inSideKarmozd" => 3 , // برون شهری ۳ درصد هزینه جنس
    "outSideKarmozd" => 1.5 , // برون شهری ۳ درصد هزینه جنس
    "cod" => 11000 ,
    "haghsabt" => 5000
];
