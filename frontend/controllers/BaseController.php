<?php


namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
class BaseController extends Controller
{

    public $enableCsrfValidation=false;


    /**
     * @param $code
     * @param $msg
     * @param $data
     * @return Response
     */
    public function formatJson($code,$msg,$data)
    {
        $data=['code'=>$code,'msg'=>$msg,'data'=>$data];
        return $this->asJson($data);
    }
}