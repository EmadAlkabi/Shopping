<?php

return [
    "index" => [
        "title" => "المواد"
    ],

    "create" => [
        "title"    => "اضافة مادة",
        "btn-send" => "ارسال"
    ],

    'store' => [
        'success' => 'تم انشاء المادة بنجاح.',
        'failed'  => 'لم يتم انشاء المادة، اعد المحاولة.',
    ],

    "edit" => [
        "btn-save" => "حفظ"
    ],

    "update" => [
        "1" => "تم تحديث المادة.",
        "0" => "لم تحدث تغييرات على المادة."
    ],

    "change-deleted" => [
        "success-0" => "تم تفعيل المادة بنجاح.",
        "success-1" => "تم تعطيل المادة بنجاح.",
        "failed-0"  => "لم يتم تفعيل المادة، اعد المحاولة.",
        "failed-1"  => "لم يتم تعطيل المادة، اعد المحاولة."
    ],

    "components" => [
        "datatable" => [
            "title-all"            => "جميع المواد",
            "title-categorized"    => "المواد المصنفة",
            "title-un-categorized" => "المواد غير المصنفة",
            "title-deleted"        => "المواد المحذوفة (المؤرشفة)",
            "btn-add"              => "اضافة",
            "column"               => [
                "number"   => "رقم",
                "name"     => "الاسم",
                "barcode"  => "Barcode",
                "code"     => "Code",
                "price"    => "السعر",
                "quantity" => "العدد"
            ]
        ],

        "modal-change-deleted" => [
            "header"          => "حالة مادة",
            "active-message"  => "هل تريد تفعيل المادة رقم (:number)؟",
            "disable-message" => "هل تريد تعطيل المادة رقم (:number)؟",
            "error-message"   => "المادة غير موجودة",
            "btn-yes"         => "نعم",
            "btn-no"          => "لا"
        ]
    ],

    "label" => [
        "name"       => "الاسم",
        "company"    => "الشركة",
        "tags"       => "الكلمات الدلالية",
        "details"    => "التفاصيل",
        "barcode"    => "Barcode",
        "code"       => "Code",
        "currency"   => "العملة",
        "price"      => "السعر",
        "unit"       => "التعبة",
        "quantity"   => "الكمية",
        "category"   => "الصنف",
        "deleted"    => "Deleted",
        "created_at" => "تاريخ الانشاء"
    ],

    "placeholder" => [
        "name"     => "اسم المادة",
        "company"  => "اسم الشركة",
        "tags"     => "اكتب بعض الاسماء الاخرى للمادة لغرض تسهيل عملية البحث",
        "details"  => "بعض التفاصيل حول المادة",
        "currency" => "اختر العملة",
        "unit"     => "اختر التعبة",
        "category" => "اختر الصنف"
    ]
];
