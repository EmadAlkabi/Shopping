<?php

return [
    "index" => [
        "title"  => "الفروع"
    ],

    "create" => [
        "title"    => "اضافة فرع",
        "note-1"   => "معلومات الفرع",
        "note-2"   => "معلومات المسؤول عن الفرع",
        "btn-send" => "ارسال",
        "notification" => [
            "title" => "فرع جديد",
            "body"  => "تم فتح فرع " . ":string"
        ]
    ],

    "store" => [
        "success" => "تم انشاء الفرع بنجاح.",
        "failed"  => "لم يتم انشاء الفرع، اعد المحاولة.",
    ],

    "label" => [
        "name"   => "اسم الفرع",
        "email"  => "البريد الالكتروني",
        "phone"  => "رقم الهاتف",
        "detail" => "بعض التفاصيل حول الفرع",
        "gps"    => "GPS",
        "state"  => "الحالة"
    ],

    "placeholder" => [
        "name"    => "اسم الفرع",
        "email"   => "البريد الالكتروني",
        "phone"   => "رقم الهاتف",
        "gps"     => "GPS",
        "state"   => "اختر حالة الفرع"
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
            "header-all"     => "جميع المواد",
            "header-deleted" => "المواد المحذوفة (المؤرشفة)",
            "btn-add"        => "اضافة",
            "column"         => [
                "number"   => "رقم",
                "name"     => "الاسم",
                "quantity&price" => "الكمية والسعر"
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


];
