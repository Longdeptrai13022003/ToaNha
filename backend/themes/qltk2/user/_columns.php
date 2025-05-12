<?php
use yii\helpers\Url;
/* @var $searchModel Backend\models\search\QuanLyUserSearch */

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'headerOptions' => ['class' => 'text-primary', 'width' => '1%']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ảnh đại diện',
        'attribute'=>'anhdaidien',
        'headerOptions' => ['width' => '1%', 'class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
        'value' => function ($model) {
            $imageWebPath = Yii::getAlias('@web/hinh-anh/') . $model->anhdaidien;
            $imageFilePath = Yii::getAlias('@webroot/hinh-anh/') . $model->anhdaidien;
            return is_file($imageFilePath) ? \yii\helpers\Html::img($imageWebPath, ['width' => '100px', 'id' => 'hinh-anh', 'class' => 'img-thumbnail']) : '';
        },
        'format'=>'raw',
        'filter'=>false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Họ tên',
        'attribute'=>'hoten',
        'headerOptions' => ['width' => 'auto'],
        'filter' => \yii\helpers\Html::activeTextInput(
                $searchModel, 'hoten', [
                    'class' => 'form-control',
                    'placeholder' => 'Họ tên'
                ]
            )
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Điện thoại',
        'attribute'=>'dien_thoai',
        'headerOptions' => ['width' => '10%'],
        'filter' => \yii\helpers\Html::activeTextInput(
                $searchModel, 'dien_thoai', [
                    'class' => 'form-control',
                    'placeholder' => 'Điện thoại KH'
                ]
            )
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Tên đăng nhập',
        'headerOptions' => ['width' => '20%'],
        'attribute'=>'username',
        'filter' => \yii\helpers\Html::activeTextInput(
                $searchModel, 'username', [
                    'class' => 'form-control',
                    'placeholder' => 'Tên đăng nhập'
                ]
            )
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Email',
        'headerOptions' => ['width' => '10%'],
        'attribute'=>'email',
        'filter' => \yii\helpers\Html::activeTextInput(
                $searchModel, 'email', [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ]
            )
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Vai trò',
        'headerOptions' => ['width' => '1%'],
        'attribute' => 'vai_tro',
        'value' => function($data) {
            $roles = explode(',', $data->vai_tro);
            $roleLines = array_map('trim', $roles);
            return implode('</br>', $roleLines);
        },
        'format' => 'raw',
        'filter' => \yii\helpers\Html::dropDownList(
            'QuanLyUserSearch[vai_tro]',
            $searchModel->vai_tro,
            \backend\models\VaiTro::$arr_vai_tro,
            ['class' => 'form-control', 'prompt' => '']
        )
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],

    [
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::toRoute(['user/update', 'id' => $data->id]), ['role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
        },
        'format' => 'raw',
        'headerOptions' => ['width' => '1%', 'class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center']
    ],
    [
        'header' => 'Xóa',
        'headerOptions' => ['class' => 'text-center', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-center'],
        'value' => function($data){
            if($data->status == 10)
                return \yii\bootstrap\Html::a('<i class="fa fa-trash"></i>', '#', ['class' => 'text-danger btn-huy-khoi-phuc-hoat-dong', 'data-value' => $data->id]);
            return '';
        },
        'format' => 'raw'
    ]
];
?>

