<?php

namespace app\backend\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Request;

class Admin extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function adminList()
    {
        $auth = new Auth();
        // 获取用户组 $groups = $auth->getGroups(session("admin.admin_id"));
        $adminInfo = db('user')->select();
        $groups = db('auth_group')->select();
        $adminArr = [];
        foreach ($adminInfo as $k => $v){
            $v['title'] = $auth->getGroups($v['id'])[0]['title'];
            $adminArr[] = $v;
        }
        $this->assign('groups',$groups);
        $this->assign('lists',$adminArr);
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function store(Request $request)
    {
        if ($request->isPost()) {
            $data = input('post.');
            $groupId = $data['groupid'];
            $data['password'] = md5('123456');
            $data['logintime'] = time();
            unset($data['groupid']);
            //事务操作
            Db::startTrans();
            try{
                $userId = db('user')->insertGetId($data);
                $groupData['group_id'] = $groupId;
                $groupData['uid'] = $userId;
                $res = db('auth_group_access')->insertGetId($groupData);
                Db::commit();
            }catch (\Exception $e){
                $res = $e->getMessage();
                Db::rollback();
            }
            halt($res);
        }
    }

    /**
     * 改变用户角色
     * 可以支持不执行SQL而只是返回SQL语句:$User->fetchSql(true)->add($data);
     */
    public function updateGroup()
    {
        if(request()->isPost()){
            $uid = input('post.uid');
            $groupId = input('post.group_id');
            $res = db('auth_group_access')->where('uid',$uid)->setField('group_id',$groupId);
            if ($res) {
                $this->success('改变用户组成功', "backend/admin/adminlist");
                exit;
            } else {
                $this->error($res["改变用户组失败"]);
                exit;
            }
        }
        $userId = input('param.id');
        $userInfo = Db::table('resty_user')
            ->alias('u')
            ->join('resty_auth_group_access access','u.id = access.uid')
            ->where(['access.uid'=>$userId])->find();
        $this->assign('groups',db('auth_group')->select());
        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
