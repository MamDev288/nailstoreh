<?php
namespace api\controllers;
class ProductController extends \yii\web\Controller
{
    public function actionIndex(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = \backend\models\Product::find()->select(['id','name','price_display'])->all();
        return[
            'data' => $data
        ];
    }
}