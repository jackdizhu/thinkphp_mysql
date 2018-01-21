thinkPHP3.2.3 + mysql + jquery
  1. 实现 登录 注册 修改密码 基本功能

php 笔记
  1. const 声明常量
  2. public 公有属性或方法 普通原型方法
  3. static 静态方法 静态的数据是存在 内存中
  4. private 私有类型 只能在该类中使用
  5. final 不能被子类所继承 不能被子类的方法覆盖
  6. protected 受保护类型 (在子类中可以通过self:: 或 parent:: 来调用, 在实例中不能通过$obj-> 来调用)

tp3.2
  1. M('User')->add($arr); 新增一条纪录
  2. M('User')->where($w_arr)->find(); 根据条件查询一条纪录
  3. M('User')->where($w_arr)->save($arr); 根据条件查询一条纪录 并修改
  4. $this->ajaxReturn($arr,'json'); ajax 返回json 数据
