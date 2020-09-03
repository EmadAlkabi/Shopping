<?php

return [
    "index" => [
        "title"  => "الطلبات"
    ],

    "update" => [
        'success-2' => 'تم قبول الطلب.',
        'success-3' => 'تم رفض الطلب.',
        'failed-2'  => 'لم يتم قبول الطلب، اعد المحاولة.',
        'failed-3'  => 'لم يتم رفض الطلب، اعد المحاولة.',
    ],

    "components" => [
        "datatable" => [
            "header" => "جميع الطلبات",
            "column" => [
                "number"     => "رقم",
                "user"       => "المستخدم",
                "request-at" => "تاريخ الطلب"
            ]
        ],
    ],

    "placeholder" => [
        "state" => "اختر الحالة"
    ]
];
