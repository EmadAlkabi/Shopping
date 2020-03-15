<?php

return [
    'column' => [
        'id'          => 'رقم',
        'vendor_id'   => 'الفرع',
        'offline_id'  => 'Offline Id',
        'name'        => 'الاسم',
        'details'     => 'التفاصيل',
        'barcode'     => 'Barcode',
        'code'        => 'Code',
        'currency'    => 'العملة',
        'price'       => 'السعر',
        'unit'        => 'التعبة',
        'quantity'    => 'العدد',
        'category_id' => 'الصنف',
        'deleted'     => 'Deleted',
        'created_at'  => 'تاريخ الانشاء',
    ],

    'placeholder' => [

    ],

    'components' => [
        'datatable' => [
            'title-categorized'    => 'كل المواد المصنفة',
            'title-un-categorized' => 'كل المواد غير المصنفة',
            'title-deleted'        => 'كل المواد المحذوفة (المؤرشفة)',

            'btn-add' => 'اضافة مادة',
        ],

        'modal-info' => [
            'header-1'      => 'معلومات حساب الطالب',
            'header-2'      => 'معلومات حساب المستمع',
            'btn-info'      => 'عرض الملف',
            'btn-dismiss'   => "لا شكرا",
            'error-message' => 'المستخدم غير موجود'
        ]
    ],

    'index' => [
        'title-1'   => 'الطلاب',
        'title-2'   => 'المستمعين'
    ],

    'create' => [
        'title-1'  => 'اضافة طالب',
        'title-2'  => 'اضافة مستمع',
        'btn-send' => 'ارسال'
    ],

    'store' => [
        'success' => 'تم انشاء الحساب بنجاح.',
        'failed'  => 'لم يتم انشاء الحساب، اعد المحاولة.'
    ],

    'show' => [
        'tab' => [
            'profile'       => 'الملف الشخصي',
            'documents'     => 'المستمسكات',
            'account-state' => 'حالة الحساب'
        ],

        'profile-tab' => [
            'btn-edit' => 'تحرير الحساب'
        ],

        'account-state-tab' => [
            'header-info'      => 'ملئ جميع معلومات الحساب.',
            'header-auth'      => 'توثيق الحساب عن طريق (البريد او الهاتف).',
            'header-documents' => 'قبول جميع المستمسكات المطلوبة.',
        ]
    ],

    'edit' => [
        'title'           => 'حساب: ',
        'change-info'     => 'تغيير معلومات الحساب',
        'change-password' => 'تغيير كلمة المرور',
        'btn-save'        => 'حفظ'
    ],

    'update' => [
        'success' => 'تم تحديث الحساب بنجاح.',
        'failed'  => 'لم يتم تحديث الحساب.'
    ]
];
