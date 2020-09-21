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
        "datatable"  => [
            "header-all"    => "جميع الطلبات",
            "header-review" => "الطلبات قيد المراجعه",
            "header-accept" => "الطلبات المقبولة",
            "header-reject" => "الطلبات المرفوضة",
            "column" => [
                "number"     => "رقم",
                "user"       => "الزبون",
                "state"      => "حالة الطلب",
                "request-at" => "تاريخ الطلب"
            ]
        ],
        "modal-show" => [
            "main-header"    => "عرض الطلب",
            "header"         => "تفاصيل الطلب",
            "label"          => [
                "user"        => [
                    "name"    => "اسم الزبون",
                    "phone"   => "قم الهاتف",
                    "address" => "العنوان"
                ],
                "number"      => "رقم الطلب",
                "state"       => "حالة الطلب",
                "request_at"  => "تاريخ الطلب",
                "response_at" => "تاريخ الاستجابة"
            ],
            "column"         => [
                "item"      => "المادة",
                "price"     => "السعر",
                "quantity"  => "العدد",
                "total"     => "المجموع",
                "total-IQD" => "المجموع بالدينار",
                "total-USD" => "المجموع بالدولار"
            ],
            "btn-accept"     => "قبول",
            "btn-reject"     => "رفض",
            "accept-message" => "تم قبول الطلب مسبقا",
            "reject-message" => "تم رفض الطلب مسبقا",
            "error-message"  => "الطلب غير موجود"
        ]
    ],

    "placeholder" => [
        "state" => "اختر الحالة"
    ]
];
