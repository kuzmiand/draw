<?php

namespace app\controllers\backend;

use Yii;
use app\components\BaseController;

class BackendController extends BaseController
{

    public function init()
    {
        parent::init();

        Yii::$app->view->theme = new \yii\base\Theme([
            'pathMap' => ['@app/views' => '@app/themes/admin/views'],
            'baseUrl' => '@web/themes/admin',
        ]);

        $this->layout = 'backend';
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


}