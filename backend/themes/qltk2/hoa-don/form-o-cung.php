<?php

use yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
/* @var $chiTiets \backend\models\QuanLyOCung[] */
/* @var $hoaDonID int */
?>
    <style>
        #loading {
            display: block;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 50px; /* Đường kính của hình tròn */
            height: 50px; /* Đường kính của hình tròn */
            border: 6px solid #f3f3f3; /* Màu nền viền */
            border-radius: 50% !important; /* Đảm bảo hình tròn */
            border-top: 6px solid #3498db; /* Màu xanh của viền xoay */
            animation: spin 1s linear infinite; /* Hiệu ứng xoay */
            transform: translate(-50%, -50%); /* Căn giữa */
            z-index: 9999; /* Hiển thị trên cùng */
        }


        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
<?php $form = ActiveForm::begin([
    'options' => [
        'autocomplete' => 'off',
        'enctype'=> 'multipart/form-data',
        'id'=>'form-o-cung'
    ]
]); ?>
<table class="table table-striped text-nowrap">
    <?= Html::hiddenInput('hoaDonID',$hoaDonID)?>
    <thead>
    <tr>
        <th>Họ tên</th>
        <th width="35%">Điện thoại</th>
        <th width="1%">Thêm</th>
        <th width="1%">Xóa</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($chiTiets)>0):?>
        <?php foreach ($chiTiets as $index => $chiTiet): ?>
            <tr>
                <?=Html::hiddenInput('id[]',$chiTiet->nguoi_o_cung_id)?>
                <td><?= $chiTiet->ho_ten?></td>
                <td><?= $chiTiet->dien_thoai?></td>
                <td><center><?= Html::a('<i class="fa fa-plus"></i>','#',['class'=>'text-primary them-o-cung'])?></center></td>
                <td><center><?= Html::a('<i class="fa fa-trash"></i>','#',['class'=>'text-danger xoa-o-cung'])?></center></td>
            </tr>
        <?php endforeach;?>
    <?php else:?>
        <tr>
            <td><?= Html::textInput('ho_ten[]','',['class'=>'form-control'])?></td>
            <td><?= Html::textInput('dien_thoai[]','',['class'=>'form-control'])?></td>
            <td><center><?= Html::a('<i class="fa fa-plus"></i>','#',['class'=>'text-primary them-o-cung'])?></center></td>
            <td><center><?= Html::a('<i class="fa fa-trash"></i>','#',['class'=>'text-danger xoa-o-cung'])?></center></td>
        </tr>
    <?php endif;?>
    </tbody>
</table>
    <div id="loading" style="display: none;"></div>
<div class="text-right">
    <?= Html::a('<i class="fa fa-save"></i> Lưu','#',['class'=>'btn btn-primary','id'=>'save-o-cung'])?>
</div>
<?php ActiveForm::end(); ?>