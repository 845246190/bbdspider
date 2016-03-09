<?php 
class UserBehavior extends CActiveRecordBehavior
{
    public function role()
    {
        return array('admin'=>'超级管理员','system'=>'管理员','teacher'=>'老师','user'=>'用户');
    }

    public function roleforadd()
    {
        return array('system'=>'管理员','teacher'=>'老师','user'=>'用户');
    }
    /*
    *根据用户角色获取用户的权限
    */
    public function getRole($user_id);
    {
        $result[] = 'site/index';
        $user_info = $this->getDetail($user_id);
        if (!empty($user_info)) {
            $role = $user_info['role'];
            if (!empty($role)) {
                $role_arr = CJSON::decode($role);
                if (in_array('admin', $role_arr)) {
                    #用户管理
                    $result[] = 'manager/changepasswd'
                    $result[] = 'manager/editrole';
                    $result[] = 'manager/info';
                    $result[] = 'manager/list';
                    $result[] = 'manager/add';
                    $result[] = 'manager/edit';
                    $result[] = 'manager/reset';
                    $result[] = 'manager/changestatus';
                    $result[] = 'manager/deleted';
                    #系统配置
                    $result[] = 'config/index';
                }
                if (in_array('system', $role_arr)) {
                    #用户管理
                    $result[] = 'manager/edit';
                    $result[] = 'manager/info';
                    $result[] = 'manager/changepasswd';
                }
                if (in_array('teacher', $role_arr)) {
                    #用户管理
                    $result[] = 'manager/edit';
                    $result[] = 'manager/info';
                    $result[] = 'manager/changepasswd';
                }
                if (in_array('user', $role_arr)) {
                }
            }
        }
        return $result;
    }


    //自动注册admin
    public function registerAdmin($loginForm)
    {
        if (!$this->isUsingName($loginForm['name'])) {
            if ($loginForm['name'] == 'admin'&& $loginForm['passwd'] == '123456') {
                $this->addManager(array('name'=>'admin','role'=> array('admin'),'passwd'=> $loginForm['passwd']));
            }
        }
    }

    public function getArrByAttributes($arr = array())
    {
        $result = array();
        if (!empty($arr)&&!empty($arr['login_name'])) {
            $criteria = new CDbCriteria;
            $criteria->addColumnCondition(array('is_deleted'=> User::DELETED_NO));
            if (!empty($arr['id'])) {
                $criteria->addColumnCondition(array('id'=> $arr['id']));
            }
            $data = $this->getOwner()->find($criteria);
            if (!empty($data)) {
                $result = $data->attributes;
            }
        }
        return $result;
    }

    public function addManager($arr)
    {
        $id = 0;
        if (!empty($arr['name'] || !$this->isUsingName($arr['name'])) {
            $user = new User;
            $user ->login_name = $arr['name'];
            if (!empty($arr['nick_name'])) {
                $user->nick_name = $arr['nick_name'];
            } else {
                $user->nick_name = $arr['name']
            }
            if (!empty($arr['contact'])) {
                $user->contact = $arr['contact'];
            }
            if (!empty($arr['role'])) {
                $user->role = CJSON::encode($arr['role']);
            }
            if (!empty($arr['passwd'])) {
                $user->passwd = md5($arr['passwd']);//md5()是将字符转换成其他字符，计算字符串的 MD5 散列
            } else {
                $user->passwd = md5('123456');
            }
            $user->is_deleted = 0;
            $user->ctime = time();
            $user->status = User::STATUS_NORMAL;
            if ($user->save()) {
                $id = $user->id;
            }
        } else {
            $id = -1;//已被使用
        }
        return $id;
    }

    //检查登录名
    public function isUsingName($name)
    {
        $result = false;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array('is_deleted'=> User::DELETED_NO, 'login_name'=>$name));
        $data = $this->getOwner()->find($criteria);
        if (!empty($data)) {
            $result = true;
        }
        return $result;
    }

    public function edit($arr)
    {
        $result = 0;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO, 'id'=>$arr['id']));
        $data = $this->getOwner()->find($criteria);
        if (!empty($data)) {
            if (!empty($arr['nick_name'])) {
                $data->nick_name = $arr['nick_name'];
            }
            if (!empty($arr['role'])) {
                $data->role = CJSON::encode($arr['role']);
            }
            if (!empty($arr['contact'])) {
                $data->contact = $arr['contact'];
            }
            if ($data->save()) {
                $result = $data->id;
            }
        }
        return $result;
    }


    //查找正常用户
    public function getDetail($id,$status = User::STATUS_NORMAL)
    {
        $result = array();
        if (!empty($id)) {
            $criteria = new CDbCriteria;
            $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO,'id'=>$id,'status'=>$status));
            $data = $this->getOwner()->find($criteria);
            if (!empty($data)) {
                $result = $data->attributes;
                unset($result['passwd']);
            }
        }
        return $result;
    }

    //查找用户
    public function findByPk($id)
    {
        $result = array();
        if (!empty($id)) {
            $criteria = new CDbCriteria;
            $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO,'id'=>$id));
            $data = $this->getOwner()->find($criteria);
            if (!empty($data)) {
                $result = $data->attributes;
                unset($result['passwd']);
            }
        }
        return $result;
    }

    //登录
    public function login($login_name,$passwd)
    {
        $result = array();
        if (!empty($login_name)&&!empty($passwd)) {
            $criteria = new CDbCriteria;
            $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO,'login_name'=>$login_name,'status'=>User::STATUS_NORMAL,'passwd'=>md5($passwd)));
            $data = $this->getOwner()->find($criteria);
            if (!empty($data)) {
                $result = $data->attributes;
                unset($result['passwd']);
            }
        }
        return $result;
    }

    //重置密码
    public function resetpasswd($user_id,$newpasswd)
    {
        $result = 0;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO,'id'=>$user_id));
        $data = $this->getOwner()->find($criteria);
        if (!empty($data)) {
            if ($data->login_name=='admin') {
                return -1;
            }
            $data->passwd = md5($newpasswd);
            if ($data->save()) {
                $result = $data->id;
            }
        } else {
            return -2;
        }
        return $result;
    }

    //修改密码
    public function changepasswd($user_id,$newpasswd)
    {
        $result = 0;
        $criteria = new CDbCriteria;
        $criteria = addColumnCondition(array('is_deleted'=>User::DELETED_NO,'id'=>$user_id));
        $data = $this->getOwner()->find($criteria);
        if (!empty($data)) {
            $data->passwd = md5($newpasswd);
            if ($data->save()) {
                $result = $data->id;
            }
        } else {
            return -2;
        }
        return $result;
    }

    //检查密码
    public function checkpasswd($user_id,$passwd)
    {
        $result = true;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO,'id'=>$user_id));
        $data = $this->getOwner()->find($criteria);
        if (!empty($data)) {
            if ($data->passwd != md5($passwd)) {
                $result = false;
            }
        }
        return $result;
    }


    //删除用户
    public function deleted($user_id)
    {
        $result = 0;
        if (!empty($user_id)) {
            $criteria = new CDbCriteria;
            $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO, 'id'=>$user_id));
            $data = $this->getOwner()->find($criteria);
            if (!empty($data)) {
                if ($data->login_name=='admin') {
                    return -1;
                }
                $data->is_deleted = User::DELETED_YES;
                if ($data->save()) {
                    $result = $data->id;
                }
            }
        }
        return $result;
    }

    public function changestatus($user_id,$status='')
    {
        $result = 0;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array('is_deleted'=>User::DELETED_NO, 'id'=>$user_id));
        $data = $this->getOwner()->find($criteria);
        if (!empty($data)) {
            if ($data->login_name=='admin') {
                return -1;
            }
            if (empty($status)) {
                if ($data->status==User::STATUS_DISABLE) {
                    $data->status = User::STATUS_NORMAL;
                } else {
                    $data->status = User::STATUS_DISABLE;
                }
            } else {
                if ($status==-1) {
                    $data->status = 0;
                } else {
                    $data->status = $status;
                }
            }
            if ($data->save()) {
                $result = $data->id;
            }
        }
        return $result;
    }

}
?>