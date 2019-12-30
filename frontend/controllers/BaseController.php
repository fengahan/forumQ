<?php


namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
class BaseController extends Controller
{


    public function formatJson($code,$msg,$data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['code'=>$code,'msg'=>$msg,'data'=>$data];
    }
}