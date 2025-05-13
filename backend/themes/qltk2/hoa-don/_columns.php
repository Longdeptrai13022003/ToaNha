<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $searchModel \backend\models\search\HoaDonSearch*/
return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '8%',
        'headerOptions' => ['class' => 'text-center bg-light'],
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Mã hóa đơn',
        'attribute' => 'ma_hoa_don',
        'width' => '10%',
        'headerOptions' => ['class' => 'bg-light'],
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
        'filter' => Html::activeTextInput(
            $searchModel,
            'ma_hoa_don',
            [
                'placeholder' => 'Mã hóa đơn',
                'class' => 'form-control',
            ]
        ),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Phòng',
        'attribute' => 'ten_phong',
        'width' => '10%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function ($data) {
            return Html::encode($data->ten_phong) . '/' . Html::encode($data->ten_toa_nha);
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
        'filter' => Html::activeTextInput(
                $searchModel,
                'ten_phong',
                [
                    'class' => 'form-control',
                    'placeholder' => 'Tên phòng',
                    'style' => 'margin-bottom: 5px;',
                ]
            ) . Html::activeTextInput(
                $searchModel,
                'ten_toa_nha',
                [
                    'class' => 'form-control',
                    'placeholder' => 'Tên tòa nhà',
                ]
            ),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'user_id',
        'label' => 'Khách hàng',
        'width' => '50%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function ($data) {
            return '<div style="display: flex; flex-wrap: wrap; gap: 10px; word-wrap: break-word;">' .
                '<div style="flex: 1; min-width: 100px; text-align: left;"><i class="fa fa-user text-primary" style="margin-right: 5px;"></i>' . Html::encode($data->hoten) . '</div>' .
                '<div style="flex: 1; min-width: 100px; text-align: right;"><i class="fa fa-phone text-success" style="margin-right: 5px;"></i>' . Html::encode($data->dien_thoai) . '</div>' .
                '</div>';
        },
        'format' => 'raw',
        'contentOptions' => ['style' => 'padding: 12px 8px;'],
        'filter' => Html::activeTextInput(
                $searchModel,
                'hoten',
                [
                    'class' => 'form-control',
                    'placeholder' => 'Tên khách',
                    'style' => 'margin-bottom: 5px;',
                ]
            ) . Html::activeTextInput(
                $searchModel,
                'dien_thoai',
                [
                    'class' => 'form-control',
                    'placeholder' => 'Điện thoại',
                ]
            ),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Người thực hiện',
        'attribute' => 'nguoi_thuc_hien',
        'width' => '1%',
        'headerOptions' => ['class' => 'bg-light'],
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
        'filter' => Html::activeTextInput(
            $searchModel,
            'nguoi_thuc_hien',
            [
                'class' => 'form-control',
                'placeholder' => 'Thực hiện',
            ]
        ),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'thang',
        'label' => 'Tháng',
        'width' => '10%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function ($data) {
            return '<span class="pull-right">' . Html::encode($data->thang) . '</span>';
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-right', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nam',
        'label' => 'Năm',
        'width' => '10%',
        'headerOptions' => ['class' => 'bg-light'],
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'trang_thai',
        'label' => 'Trạng thái',
        'width' => '1%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function ($data) {
            if ($data->trang_thai == \backend\models\HoaDon::DA_THANH_TOAN) {
                return '<span class="label label-success"><i class="fa fa-check-circle" style="margin-right: 5px;"></i>' . \backend\models\HoaDon::DA_THANH_TOAN . '</span>';
            } else {
                return '<span class="label label-warning"><i class="fa fa-refresh" style="margin-right: 5px;"></i>' . \backend\models\HoaDon::CHUA_THANH_TOAN . '</span>';
            }
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
        'filter' => Html::activeDropDownList(
            $searchModel,
            'trang_thai',
            [
                \backend\models\HoaDon::CHUA_THANH_TOAN => \backend\models\HoaDon::CHUA_THANH_TOAN,
                \backend\models\HoaDon::DA_THANH_TOAN => \backend\models\HoaDon::DA_THANH_TOAN,
            ],
            ['class' => 'form-control', 'prompt' => 'Tất cả']
        ),
    ],
    [
        'header' => 'Xem',
        'width' => '1%',
        'value' => function ($data) {
            return Html::a('<i class="fa fa-eye text-primary"></i>', Url::toRoute(['hoa-don/view', 'id' => $data->id]), [
                'role' => 'modal-remote',
                'data-toggle' => 'tooltip',
                'id' => 'select2',
                'class' => 'btn btn-sm',
            ]);
        },
        'format' => 'raw',
        'headerOptions' => ['class' => 'text-center bg-light'],
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'header' => 'In',
        'width' => '1%',
        'value' => function ($data) {
            return Html::a('<i class="fa fa-print text-primary"></i>', '#', [
                'class' => 'btn-print btn btn-sm',
                'data-value' => $data->id,
                'loai-in' => 'mot',
            ]);
        },
        'format' => 'raw',
        'headerOptions' => ['class' => 'text-center bg-light'],
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'header' => 'Xóa',
        'width' => '1%',
        'value' => function ($data) {
            if ($data->active == 1) {
                return Html::a('<i class="fa fa-ban text-danger"></i>', '#', [
                    'class' => 'btn btn-sm',
                    'data-value' => $data->id,
                    'id' => 'btn-huy-hoa-don',
                ]);
            }
            return '';
        },
        'format' => 'raw',
        'headerOptions' => ['class' => 'text-center bg-light'],
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
];
?>