<?php 
/**
*用户
*
**/
class ManagerController extends Controller
{
    public function actionList()
    {
        $filter['key'] = Yii::app()->request->getQuery('key');
        $filter['status'] = Yii::app()->request->getQuery('status');
        $filter['page'] = Yii::app()->request->getQuery('page',1);
        $filter['page_size'] = Yii::app()->request->getQuery('page_size',10);
        $result = User::model()->listByAttr($filter);

        $this->crumbs[0]['href'] = '/manager/list';
        $this->crumbs[0]['name'] = '用户管理';
        $this->pageTitle = "用户管理";

        //获取权限列表，添加用户时使用
        $role_list = User::model()->roleforadd();
        $this->render('list',compact('role_list','filter','result'));
    }

    public function actionAdd()
    {
        if (Yii::app()->request->isPostRequest)
        {
            $user = Yii::app()->request->getPost('user');
            if (empty($user['name'])) {
                $this->showError('登录名不能为空',$this->referrer);
                return;
            }
            if (User::model()->isUsingName($user['name'])) {
                $this->showError('登录名已被占用，请重新填写',$this->referrer);
                return;
            }
            if (empty($user['role'])) {
                $this->showError('角色不能为空',$this->referrer);
                return;
            }
            $result = User::model()->addManager($user);
            if ($result>0) {
                $this->showSuccess('添加成功!',$this->referrer);
            } else {
                $this->showError('添加失败!',$this->referrer);
            }
        }
    }


    public function actionCheckname()
    {
        $result['error_no'] = 0;
        $result['message'] = '';
        $name = Yii::app()->request->getPost('name');
        if (empty($name)) {
            $result['error_no'] = 1;
            $result['message'] = '登录名为空';
            echo CJSON::encode($result);
            return;
        }
        if (User::model()->isUsingName($name)) {
            $result['error_no'] = 2;
            $result['message'] = "登录名已被占用，请重新填写";
            echo CJSON::encode($result);
            return;
        } else {
            $result['message'] = "可以使用";
            echo CJSON::encode($result);
        }
    }


    public function actionReset()
    {
        if (Yii::app()->request->isPostRequest) {
            $user = Yii::app()->request->getPost('user');
            if (Yii::app()->user->getName() != 'admin') {
                $this->showError('非法操控',$this->referrer);
            }
            if (empty($user['new_passwd'])) {
                $this->showError('新密码不能为空',$this->referrer);
                return;
            }
            if (empty($user['re_passwd'])) {
                $this->showError('重复密码不能为空',$this->referrer);
                return;
            }
            if ($user['new_passwd'] != $user['re_passwd']) {
                $this->showError('新密码与重复密码不一致',$this->referrer);
                return;
            }
            //修改密码
            $result = User::model()->resetpasswd($user['id'],$user['new_passwd']);
            if ($result>0) {
                $this->showSuccess('修改成功！',$this->referrer);
            } else if($result==-1) {
                $this->showError('不能对超级管理员进行操作！',$this->referrer);
            } else if ($result==-2) {
                $this->showError('用户不存在！',$this->referrer);
            } else {
                $this->showError('服务器忙，请稍后再试！',$this->referrer);
            }
        } else {
            $user_id = Yii::app()->request->getQuery('user_id');
            $user_info = User::model()->getDetail($user_id);
            $this->render('reset',compact('user_info'));
        }
    }

    public function actionChangepasswd()
    {
        if (Yii::app()->request->isPostRequest) {
            $user = Yii::app()->request->getPost('user');
            $use['id'] = Yii::app()->user->getId();
            if (empty($user['id'])) {
                $this->showError('用户不能为空',$this->referrer);
                return;
            }
            if (empty($user['old_passwd'])) {
                $this->showError('旧密码不能为空',$this->referrer);
                return;
            }
            if (empty($user['new_passwd'])) {
                $this->showError('新密码不能为空',$this->referrer);
                return;
            }
            if (empty($user['re_passwd'])) {
                $this->showError('重复密码不能为空',$this->referrer);
                return;
            }
            if (!User::model()->checkPasswd($user['id'],$user['old_passwd'])) {
                $this->showError('旧密码不正确',$this->referrer);
                return;
            }
            if ($user['new_passwd'] != $user['re_passwd']) {
                $this->showError('新密码与重复密码不一致');
                return;
            }
            // 修改密码
            $result = User::model()->changepasswd($user['id'],$user['new_passwd']);
            if ($result>0) {
                $this->showSuccess('修改成功！',$this->referrer);
            } else if ($result == -2) {
                $this->showError('用户不存在！',$this->referrer);
            } else {
                $this->showError('服务器忙，请稍后再试！',$this->referrer);
            }
        } else {
            $user_id = Yii::app()->request->getQuery('user_id');
            $user_info = User::model()->getDetail($user_id);
            $this->render('reset',compact('user_info'));
        }
    }

    public function actionDeleted()
    {
        if (Yii::app()->request->isPostRequest) {
            $error_msg = "删除成功！";
            $error_code = 0;
            $user_id_arr = Yii::app()->request->getPost('user_id_arr',array());
            if (empty($user_id_arr) || !is_array($user_id_arr)) {
                $this->showError('未选择用户',$this->referrer);
            } else {
                foreach ($user_id_arr as $key => $value) {
                    $result_data = User::model()->deleted($value);
                    if ($result_data == -1) {
                        $error_msg = '不能对超级管理员进行操作！';
                        $error_code = 1;
                    }
                }
                if ($error_code == 1) {
                    $this->showError($error_msg,$this->referrer);
                } else {
                    $this->showSuccess($error_msg,$this->referrer);
                }
            }
        } else {
            $user_id = Yii::app()->request->getQuery('user_id');
            if (empty($user_id)) {
                $this->showError('未选择用户',$this->referrer);
                return;
            }
            $result = User::model()->deleted($user_id);
            if ($result>0) {
                $this->showError('删除成功！',$this->referrer);
                return;
            } else if ($result == -1) {
                $this->showError('不能对超级管理员进行操作',$this->referrer);
            } else {
                $this->showError('删除失败！',$this->referrer);
            }
        }
    }

    public function actionChangestatus()
    {
        if (Yii::app()->request->isPostRequest) {
            $error_msg = '操作成功！';
            $error_code = 0;
            $user_id_arr = Yii::app()->request->getPost('user_id_arr',array());
            $status = Yii::app()->request->getPost('status',User::STATUS_DISABLE);
            if (empty($user_id_arr) || !is_array($user_id_arr)) {
                $this->showError('未选择用户',$this->referrer);
            } else {
                foreach ($user_id_arr as $key => $value) {
                    $result_data = User::model()->changestatus($value,$status);
                    if ($result_data ==-1) {
                        $error_msg = '不能对超级管理员进行操作！';
                        $error_or = 1;
                    }
                }
                if ($error_code == 1) {
                    $this->showError($error_msg,$this->referrer);
                } else {
                    $this->showSuccess($error_msg,$this->referrer);
                }
            }
        } else {
            $user_id = Yii::app()->request->getQuery('user_id');
        }
    }
}
?>