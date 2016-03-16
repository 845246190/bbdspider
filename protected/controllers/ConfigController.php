<?php
class ConfigController extends Controller
{
    public function actionIndex()
    {
        if (Yii::app()->request->isPostRequest) {
            // 获取表单数据
            $paper_title = Yii::app()->request->getPost('paper_title');

            // 保存数据
            Config::model()->set('paper_title', $paper_title, 'system');
            $this->rendirect('/config/index');
        } else {
            // 获取数据库里的数据
            $data['pager_title'] = Config::model()->get('paper_title','system');
            // render页面
            $this->setPageTitle('系统设置');
            $this->render('setting', compact('data'));
        }
    }
}
?>