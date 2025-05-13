<?php
use yii\helpers\Url;
use yii\bootstrap\Html;
use backend\models\DanhMuc;

$this->registerCss("
    .table .btn {
        border-radius: 6px !important;
    }
    .table .btn-sm {
        border-radius: 6px !important;
    }
    .label{
        border-radius: 6px !important;
    }
");
/* @var $searchModel backend\models\search\DanhMucSearch */
return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => '<i class="fas fa-hashtag"></i> STT',
        'headerOptions' => [
            'width' => '60px',
            'class' => 'text-center  text-white'
        ],
        'contentOptions' => ['class' => 'text-center align-middle'],
        'width' => '60px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
        'label' => 'Tên danh mục',
        'headerOptions' => ['class' => ' text-white'],
        'contentOptions' => ['class' => 'align-middle font-weight-bold'],
        'format' => 'raw',
        'value' => function($data) {
            $icon = ($data->type == DanhMuc::TOA_NHA)
                ? '<i class="fas fa-building text-primary mr-2"></i>'
                : '<i class="fas fa-door-open text-success mr-2"></i>';
            return $icon . Html::encode($data->name);
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'type',
        'label' => 'Loại',
        'headerOptions' => ['width' => '15%', 'class' => ' text-white'],
        'contentOptions' => ['class' => 'align-middle'],
        'filter' => Html::activeDropDownList(
            $searchModel, 'type',
            [
                DanhMuc::TOA_NHA => DanhMuc::TOA_NHA,
                DanhMuc::PHONG_O => DanhMuc::PHONG_O,
            ],
            ['class' => 'form-control', 'prompt' => 'Tất cả']
        ),
        'format' => 'raw',
        'value' => function($data) {
            if ($data->type == DanhMuc::TOA_NHA) {
                return '<span class="label label-primary rounded"><i class="fas fa-building mr-1"></i> ' . Html::encode($data->type) . '</span>';
            } else {
                return '<span class="label label-success rounded"><i class="fas fa-door-open mr-1"></i> ' . Html::encode($data->type) . '</span>';
            }
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'active',
        'label' => 'Toà nhà',
        'headerOptions' => ['width' => '18%', 'class' => ' text-white'],
        'contentOptions' => ['class' => 'align-middle'],
        'format' => 'raw',
        'value' => function($data) {
            if ($data->parent_id != '') {
                $toaNha = DanhMuc::findOne($data->parent_id);
                if ($toaNha) {
                    return '<span class="label bg-primary text-white p-2 rounded">' .
                        '<i class="fas fa-building mr-1"></i> ' .
                        Html::encode($toaNha->name) .
                        '</span>';
                }
            }
            return '<span class="text-muted"><i class="fas fa-minus"></i></span>';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'don_gia',
        'label' => 'Đơn giá',
        'headerOptions' => ['width' => '12%', 'class' => 'text-right  text-white'],
        'contentOptions' => ['class' => 'text-right align-middle font-weight-bold'],
        'format' => 'raw',
        'value' => function($data) {
            if ($data->type == DanhMuc::TOA_NHA) {
                return '<span class="text-muted">—</span>';
            }
            if ($data->don_gia > 0) {
                return '<span class="text-success">' .
                    number_format($data->don_gia, 0, '', '.') .
                    '<small class="ml-1">đ</small></span>';
            }
            return '<span class="text-muted">0 đ</span>';
        },
    ],
    [
        'header' => '<i class="fas fa-calendar-alt"></i> Lịch',
        'headerOptions' => ['class' => 'text-center ', 'width' => '70px'],
        'contentOptions' => ['class' => 'text-center align-middle'],
        'format' => 'raw',
        'value' => function($data) {
            return Html::a(
                '<i class="fas fa-calendar-alt"></i>',
                Url::to(['get-lich-dat', 'id' => $data->id]),
                [
                    'class' => 'btn btn-info btn-sm rounded',
                    'role' => 'modal-remote',
                    'title' => 'Xem lịch đặt',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top'
                ]
            );
        }
    ],
    [
        'header' => '<i class="fas fa-edit"></i> Sửa',
        'headerOptions' => ['class' => 'text-center ', 'width' => '70px'],
        'contentOptions' => ['class' => 'text-center align-middle'],
        'format' => 'raw',
        'value' => function($data) {
            return Html::a(
                '<i class="fas fa-edit"></i>',
                Url::to(['update-toa-nha-phong-o', 'id' => $data->id]),
                [
                    'class' => 'btn btn-warning btn-sm rounded',
                    'role' => 'modal-remote',
                    'title' => 'Cập nhật thông tin',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top'
                ]
            );
        }
    ],
    [
        'header' => '<i class="fas fa-trash-alt"></i> Xóa',
        'headerOptions' => ['class' => 'text-center', 'width' => '70px'],
        'contentOptions' => ['class' => 'text-center align-middle'],
        'format' => 'raw',
        'value' => function($data) {
            return Html::a(
                '<i class="fas fa-trash-alt"></i>',
                '#',
                [
                    'class' => 'btn btn-danger btn-sm rounded',
                    'id' => 'xoa-phong',
                    'data-value' => $data->id,
                    'title' => 'Xóa dữ liệu',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top'
                ]
            );
        }
    ]
];



