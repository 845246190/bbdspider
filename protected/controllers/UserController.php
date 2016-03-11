<?php
class UserController extends Controller
{
	public function actionIndex()
	{
		$user_id = Yii::app()->user->getId();
        $user_info = User::model()->getDetail($user_id);
        $this->render('index',compact('user_info'));
	}

    public function actionLogin()
    {
        if (Yii::app()->request->isPostRequest) {
            $loginForm = Yii::app()->request->getPost('loginForm');
            User::model()->registerAdmin($loginForm);
            $identity = new UserIdentity($loginForm['name'],$loginForm['passwd']);
            if ($identity->authenticate()) {
                $duration = 0;
                Yii::app()->user->login($identity, $duration);
                $this->showSuccess('登录成功，欢迎进入教育系统！','/');
            } else {
                $this->showError($identity->errorMessage,'/user/login');
            }
        } else {
            if (Yii::app()->user->getIsGuest()) {
                $this->pageTitle = "登录";
                $this->render("login");
            } else {
                $this->redirect('/');
            }
        }
    }

    public function actionLoginout()
    {
        Yii::app()->user->loginout(false);
        $this->rendirect('/user/login');
    }

    public function actionError()
    {
        if ($error=Yii::app()->errorHandle->error)
        {
            if (Yii::app()->request->isAjaxRequest)
            {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }
}