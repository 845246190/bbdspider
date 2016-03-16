<?php $this->widget('CrumbsWidget');?>
<link href="/statics/plugins/newdropkick.css" rel="stylesheet"/>
<div class="training_main">
    <div class="user_head">
        <div class="detail_navs_box">
            <ul class="user_navs_cont left_ul">
                <li>
                    <a class="href_btn btn add_btn"  href="#add_user_ceng" id="add_btn">添加</a>
                </li>
                <li>
                    <a class="href_btn btn role_btn dis_btn" href="#role_management" id="role_btn">角色管理</a>
                </li>
                <li>
                    <a class="href_btn btn reset_btn dis_btn" href="#reset_user_password" id="reset_btn">重置密码</a>
                </li>
                <li>
                    <a class="href_btn btn disable_btn dis_btn" href="#status_exchange" id="disable_btn">禁用</a>
                </li>
                <li>
                    <a class="href_btn btn use_btn dis_btn" href="#status_exchang_use" id="use_btn">启用</a>
                </li>
                <li>
                    <a class="href_btn btn delete_btn dis_btn" href="#del_subject" id="delete_btn">删除</a>
                </li>
            </ul>
            <ul class="user_navs_cont right_ul">
                <form method="get" action="/manager/list">
                    <li>
                        <input class="search_box" placeholder="输入搜索内容" value="<?php if (!empty($filter['key'])) echo $filter['key']?>" type="text" name="key" />
                    </li>
                    <li>
                        <div class="user_status">
                            <div class="select_box">
                                <select name="status" class="default select hide">
                                    <option value="0" <?php if (empty($filter['status'])) echo "selected='selected'"?>>全部</option>
                                    <option value="2" <?php if (!empty($filter['status']) && $filter['status']==2) echo "selected='true'"?>>禁用</option>
                                    <option value="1" <?php if (!empty($filter['status']) && $filter['status']==1) echo "seleted='true'"?>>启用</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <input type="submit" value="" class="search_submit" />
                    </li>
                </form>
            </ul>
        </div>
    </div>
    <div class="clear_float"></div>
    <div class="user_table">
        <table class="question_main_table">
            <thead>
                <tr style="border-top:0;border-bottom:2px solid #E2E3E3">
                    <td width="100px">
                        <input type="checkbox" class="checkbox all_check">
                        <span>全选</span>
                    </td>
                    <td width="" align="center">编号</td>
                    <td width="" align="center">登录名</td>
                    <td width="" align="center">姓名</td>
                    <td width="" align="center">角色</td>
                    <td width="" align="center">联系方式</td>
                    <td width="" align="center">状态</td>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($result['data'])): ?>
                    <?php foreach ($result['data'] as $key => $value) :?>
                        <tr>
                            <td width="80px">
                                <input type="checkbox" value="<?php echo $value['id'] ?>" class="checkbox list_check">
                            </td>
                            <td width="125px" align="center"><?php echo $key+1 ?></td>
                            <td width="125px" align="center" title="<?php if (!empty($value['login_name'])) echo $value['login_name']?>"><?php echo StringTools::cutStr($value['login_name'], '5') ?></td>
                            <td width="125px" align="center" title="<?php if (!empty($value['nick_name'])) echo $value['login_name']?>"><?php echo StringTools::cutStr($value['nick_name'], '5')?></td>
                            <td width="125px" align="center">
                                <?php if (!empty($value['role_arr'])) : ?>
                                    <?php foreach ($value['role_arr'] as $rk => $rv) :?>
                                        <input type="hidden" class="role_input" value="<?php echo $rk; ?>"/>
                                        <?php echo $rv; ?><?php if ($rk != count($value['role_arr'])-1) echo ',' ?>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </td>
                            <td width="125px" align="center" title="<?php if (!empty($value['contact'])) echo $value['contact'] ?>"><?php if(!empty($value['contact'])) echo StringTools::cutStr($value['contact'], '8')?></td>
                            <td width="125px" align="center"><?php if ($value['status'] == 0) echo '已启用' ?><?php if ($value['status'] == 1) echo '<span class="font_color">已禁用</span>'?></td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
        <?php 
            $url = '/manager/list/';
            if (!empty($filter))
            {
                if (!empty($filter['status'])) {
                    $url = $url.'status/'.$filter['status'].'/';
                }
                if (!empty($filter['key'])) {
                    $url = $url.'key/'.$filter['key'].'/';
                }
            }
        ?>
        <?php $this->widget('PageLinkWidget', array('url'=>$url,'pager'=>$result['pager']));?>
    </div>
</div>

<!-- 提示禁用 -->
<div class="hide">
    <div id="status_exchange">
        <div class="hide dis_form">
            <form method="post" action="/manager/changestatus">
            </form>
        </div>
        <h1 class="tan_title"><span><img src="/statics/imgs/jinggao.png"><b>禁用</b></span></h1>
        <div class="edit_cont">
            <p>你确定要<b>禁用</b>选择的用户吗？</p>
            <div class="sure_do">
                <a class="btn sure" href="">确定</a>
                <a class="btn no">关闭</a>
            </div>
        </div>
    </div>
</div>

<!-- 提示启用 -->
<div class="hide">
    <div id="status_exchange_use">
        <div class="hide dis_form">
            <form method="post" action="/manager/changestatus">
            </form>
        </div>
        <h1 class="tan_title"><span><img src="/statics/imgs/jinggao.png"><b>启用</b></span></h1>
        <div class="edit_cont">
            <p>你确定要<b>启用</b>选择的用户吗？</p>
            <div class="sure_do">
                <a class="btn sure" href="">确定</a>
                <a class="btn no">关闭</a>
            </div>
        </div>
    </div>
</div>

<!-- 角色管理 -->
<div class="hide">
    <div id="role_management">
        <h1 class="tan title">角色管理</h1>
        <div class="edit_cont">
            <form method="post" action="/manager/editrole">
                <input type="hidden" class="user_id" name="user[id]"/>
                <div class="checkbox_box">
                    <?php if (!empty($role_list)) :?>
                        <?php foreach ($role_list as $rk => $rv) :?>
                            <label>
                                <input type="checkbox" class="acheckbox" name="user[role][]" value="<?php echo $k?>">
                                <span><?php echo $rv; ?></span>
                            </label>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
                <div class="sure_do">
                    <a class="btn sure" href="">确定</a>
                    <a class="btn no">关闭</a>
                </div>
            </form>
        </div>
    </div>
</div>