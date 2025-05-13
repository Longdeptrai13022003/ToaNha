<?php

/* @var $searchModel \backend\models\search\QuanLyGiaoDichSearch*/

use backend\models\GiaoDich;
use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ma_hop_dong',
        'label' => 'Hợp đồng',
        'width' => '1%',
        'headerOptions' => ['class' => 'bg-light'],
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ma_hoa_don',
        'label' => 'Hóa đơn',
        'width' => '1%',
        'headerOptions' => ['class' => 'bg-light'],
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ten_phong',
        'label' => 'Phòng',
        'width' => '1%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function($data) {
            return Html::encode($data->ten_phong) . ' / ' . Html::encode($data->ten_toa_nha);
        },
        'format' => 'raw',
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
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'hoten',
        'label' => 'Khách hàng',
        'width' => 'auto',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function($data) {
            return '<div style="word-wrap: break-word;">' .
                '<i class="fa fa-user text-primary" style="margin-right: 5px;"></i>' . Html::encode($data->hoten) . '|' .
                '<i class="fa fa-phone text-success" style="margin-right: 5px;"></i>' . Html::encode($data->dien_thoai) .
                '</div>';
        },
        'format' => 'raw',
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
        'contentOptions' => ['style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'created',
        'label' => 'Ngày thực hiện',
        'width' => '8%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function($data) {
            $parts = explode(' ', $data->created);
            return '<div class="text-center">' . implode('/', array_reverse(explode('-', $parts[0]))) . '</div>';
        },
        'format' => 'raw',
        'filter' => Html::activeTextInput(
                $searchModel,
                'created',
                [
                    'class' => 'form-control',
                    'placeholder' => 'Thời gian từ',
                    'id' => 'thoi-gian-tu',
                    'style' => 'margin-bottom: 5px;',
                ]
            ) . Html::activeTextInput(
                $searchModel,
                'ghi_chu',
                [
                    'class' => 'form-control',
                    'placeholder' => 'Thời gian đến',
                    'id' => 'thoi-gian-den',
                ]
            ),
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nguoi_thuc_hien',
        'label' => 'Người thực hiện',
        'width' => '1%',
        'headerOptions' => ['class' => 'bg-light'],
        'filter' => Html::activeTextInput(
            $searchModel,
            'nguoi_thuc_hien',
            [
                'class' => 'form-control',
                'placeholder' => 'Thực hiện',
            ]
        ),
        'contentOptions' => ['class' => 'text-nowrap', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tong_tien',
        'label' => 'Số tiền',
        'width' => '8%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function($data) {
            return '<div class="text-right text-success" style="font-weight: bold;">' . number_format($data->tong_tien, 0, ',', '.') . ' VNĐ</div>';
        },
        'format' => 'raw',
        'filter' => false,
        'contentOptions' => ['style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'trang_thai_giao_dich',
        'label' => 'Trạng thái',
        'width' => '8%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function($data) {
            if ($data->trang_thai_giao_dich == GiaoDich::THANH_CONG) {
                return '<span class="label label-success"><i class="fa fa-check-circle" style="margin-right: 5px;"></i>' . GiaoDich::THANH_CONG . '</span>';
            } elseif ($data->trang_thai_giao_dich == GiaoDich::KHONG_THANH_CONG) {
                return '<span class="label label-danger"><i class="fa fa-ban" style="margin-right: 5px;"></i>' . GiaoDich::KHONG_THANH_CONG . '</span>';
            } else {
                return '<span class="label label-warning"><i class="fa fa-refresh" style="margin-right: 5px;"></i>' . GiaoDich::KHOI_TAO . '</span>';
            }
        },
        'format' => 'raw',
        'filter' => Html::activeDropDownList(
            $searchModel,
            'trang_thai_giao_dich',
            [
                GiaoDich::KHOI_TAO => GiaoDich::KHOI_TAO,
                GiaoDich::THANH_CONG => GiaoDich::THANH_CONG,
                GiaoDich::KHONG_THANH_CONG => GiaoDich::KHONG_THANH_CONG,
            ],
            ['class' => 'form-control', 'prompt' => 'Tất cả']
        ),
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ma_id_casso',
        'label' => 'Loại giao dịch',
        'width' => '8%',
        'headerOptions' => ['class' => 'bg-light'],
        'value' => function($data) {
            $type = $data->hoa_don_id == null ? 'Giao dịch hợp đồng' : 'Giao dịch hóa đơn';
            $color = $data->hoa_don_id == null ? 'label-primary' : 'label-info';
            return '<span class="label ' . $color . '">' . Html::encode($type) . '</span>';
        },
        'format' => 'raw',
        'filter' => false,
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'header' => 'Xem',
        'width' => '1%',
        'value' => function($data) {
            return Html::a('<i class="fa fa-eye text-primary"></i>', Url::toRoute(['giao-dich/view', 'id' => $data->id]), [
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
        'header' => 'Duyệt',
        'width' => '1%',
        'value' => function($data) {
            if ($data->trang_thai_giao_dich != GiaoDich::KHOI_TAO) {
                return '';
            }
            return Html::a('<i class="fa fa-check-circle text-success"> Duyệt</i>', '#', [
                    'class' => 'btn-duyet-trang-thai btn btn-sm',
                    'data-pjax' => 0,
                    'data-value' => $data->id,
                    'loai' => 1,
                    'style' => 'margin-right: 5px;',
                ]) . '<br>' . Html::a('<i class="fa fa-ban text-danger"> Huỷ</i>', '#', [
                    'class' => 'btn-duyet-trang-thai btn btn-sm',
                    'data-pjax' => 0,
                    'data-value' => $data->id,
                    'loai' => 0,
                ]);
        },
        'format' => 'raw',
        'headerOptions' => ['class' => 'text-center bg-light'],
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'header' => 'Gửi tin',
        'width' => '1%',
        'value' => function($data) {
            if ($data->trang_thai_giao_dich != GiaoDich::KHOI_TAO) {
                return '';
            }
            return Html::a('<i class="fa fa-send text-info"></i>', '#', [
                'class' => 'btn btn-sm btn-gui-tin',
                'data-pjax' => 0,
                'data-value' => $data->id,
            ]);
        },
        'format' => 'raw',
        'headerOptions' => ['class' => 'text-center bg-light'],
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
    [
        'header' => 'Hủy',
        'width' => '1%',
        'value' => function($data) {
            if ($data->trang_thai_giao_dich != GiaoDich::KHOI_TAO) {
                return '';
            }
            return Html::a('<i class="fa fa-trash text-danger"></i>', '#', [
                'class' => 'btn btn-sm',
                'id' => 'btn-huy-giao-dich',
                'data-value' => $data->id,
            ]);
        },
        'format' => 'raw',
        'headerOptions' => ['class' => 'text-center bg-light'],
        'contentOptions' => ['class' => 'text-center', 'style' => 'padding: 12px 8px;'],
    ],
];
?>