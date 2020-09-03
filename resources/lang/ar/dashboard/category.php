<?php

return [
    "index" => [
        "title" => "الاصناف"
    ],

    "create" => [
        "title"    => "اضافة صنف",
        "note"     => "الصنف الرئيسي لا يكون تحت اي صنف آخر.",
        "btn-send" => "ارسال"
    ],

    "store" => [
        "success" => "تم انشاء الصنف بنجاح.",
        "failed"  => "لم يتم انشاء الصنف، اعد المحاولة."
    ],

    "show" => [],

    "edit" => [
        "note"         => "الصنف الرئيسي لا يكون تحت اي صنف آخر.",
        "change-info"  => "تغيير المعلومات",
        "change-image" => "تغيير الصورة",
        "btn-save"     => "حفظ"
    ],

    "update" => [
        "success" => "تم تحديث الصنف بنجاح.",
        "failed"  => "لم يتم تحديث الصنف، اعد المحاولة."
    ],

    "destroy" => [],

    "components" => [
        "datatable" => [
            "header-all"  => "جميع الاصناف",
            "header-main" => " الاصناف الرئيسية",
            "header-sub"  => "الاصناف الفرعية",
            "btn-add"     => "اضافة",
            "column"      => [
                "number" => "رقم",
                "name"   => "الاسم",
                "parent" => "الصنف الرئيسي"
            ]
        ]
    ],

    "label" => [
        "name"  => "الاسم",
        "image" => "الصورة",
        "parent" => "الصنف الرئيسي"
    ],

    "placeholder" => [
        "name"  => "اسم الصنف",
        "image" => "اختر الصورة",
        "parent" => "اختر الصنف الرئيسي"
    ]
];