<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'describe')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price_in')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source_id')->textInput() ?>

    <?= $form->field($model, 'price_out')->textInput() ?>

    <?= $form->field($model, 'price_display')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <div>
        <button type="button" class="btn btn-primary add-detail">Thêm chi tiết</button>
        <?php
            foreach ($model->getProductDetails()->all() as $item){
                echo ('<div class="row" style="margin-top: 1em"><div class="col-lg-6"><input class="form-control" placeholder= "nhập tên kiểu"  value="'.$item->name.'" name="Product[type]['.$item->id.']"></div><div class="col-lg-5"><input value="'.$item->price.'"  class="form-control" name="Product[typePrice]['.$item->id.'] placeholder= "Giá"></div><div class="col-lg-1"><button class="btn btn-danger" onclick="$(this).parent().parent().remove()">Xoá</button>  </div></div>');
            }
        ?>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    <?=$this->registerJs("
        $('.add-detail').on('click',function (){
            let time = Date.now() 
             $(this).parent().append('<div class=\"row\" style=\"margin-top: 1em\"><div class=\"col-lg-6\"><input class=\"form-control\" placeholder= \"nhập tên kiểu\"  name=\"Product[type]['+time+']\"></div><div class=\"col-lg-5\"><input class=\"form-control\" name=\"Product[typePrice]['+time+']\" placeholder= \"Giá\"></div><div class=\"col-lg-1\"><button class=\"btn btn-danger\" onclick=\"$(this).parent().parent().remove()\">Xoá</button>  </div></div>')
        })")?>
</div>