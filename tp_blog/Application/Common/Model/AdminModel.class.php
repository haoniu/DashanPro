<?php
namespace Common\Model;
use Think\Model;
/**
 * 管理员模型
 */
class AdminModel extends Model{

    /**
     * [vLogin] 验证登录
     */
    public function vLogin($aname,$password){
        
    // 1.判断用户名是否存在
        // 获取旧数据
        $data = $this->where("aname='{$aname}'")->find();
        // 如果不存在
        if (!$data) {
            // 把错误信息放到模型的error属性中，外面geterror就可以得到错误
            $this->error = "用户名{$aname}不存在";
            return false;
        }
        // 2.判断密码是否正确
        $password = $this->encrypt($aname,$password);
        if ($password != $data['password']) {
            $this->error = "密码错误";
            return false;
        }
        // 存session
        session('aname',$aname);
        session('aid',$data['aid']);
        return true;
    }
    /**
     * 修改密码
     */
    public function changeData($password,$newPassword,$confirmPassword){

        $aid = session('aid');
        $aname = session('aname');
        // 把提交的旧密码加密
        $password=$this->encrypt($aname,$password);

        // 1.判断提交旧密码是否正确
        // 获取旧数据
        $data = $this->where("aid={$aid}")->find();
        if ($data['password']!=$password) {
            $this->error = '旧密码错误';
            return false;
        }
        // 2.判断两次密码是否相同
        // 获取提交的新密码和确认密码
        if ($newPassword!=$confirmPassword) {
            $this->error = '两次密码不一致';
            return false;
        }
        // 3.修改密码
        // 给新密码加密
        $password=$this->encrypt($aname,$newPassword);
        // 保存新数据
        $this->where("aid={$aid}")->save(array('password'=>$password));
        return true;
    }
    /**
     * [encrypt] 超级加密
     */
    public function encrypt($aname,$password){
        return md5(md5($aname) . md5($password) .'dashan');
    }

}