# thinkPHP3.2.3 + mysql + jquery

  1. 实现 登录 注册 修改密码 基本功能

# 记录

    // html 地址
    http://127.0.0.1/thinkphp_mysql/tp_app1/
    // api 地址
    http://127.0.0.1/thinkphp_mysql/thinkphp/public/index.php/index/Register/index

# php 笔记

``` js
// $json stdClass Object 取对象属性
stdClass Object
(
  [client_id] => 1
  [client_name] => aa
  [email] => example2@gmail.com
  [pass] => 1111
  [dob] => 1986-12-20
  [tob] => 00:00:00
)
$json->client_id // php 取 Object 对象属性
```
``` php
// 取 public 定义数据
public static $key = "example_key";
public function index(){
  $k = $this::$key
}
// 错误捕获
try
{
  // 解密
  $decoded = JWT::decode($jwt, $this::$key, array('HS256'));
}
//捕获异常
catch(Exception $e)
{

  $decoded = 'token validation error';
}
```

# jwt 参数组成

``` js
{
  // nbf (Not Before)：如果当前时间在nbf里的时间之前，则Token不被接受；一般都会留一些余地，比如几分钟；，是否使用是可选的；
  "nbf": 1357000000,
  // iss: 该JWT的签发者，是否使用是可选的；
  "iss": "Online JWT Builder",
  // iat(issued at): 在什么时候签发的(UNIX时间)，是否使用是可选的；
  "iat": 1416797419,
  // exp(expires): 什么时候过期，这里是一个Unix时间戳，是否使用是可选的；
  "exp": 1448333419,
  // aud: 接收该JWT的一方，是否使用是可选的；
  "aud": "www.example.com",
  // sub: 该JWT所面向的用户，是否使用是可选的；
  "sub": "jrocket@example.com",
  "GivenName": "Johnny",
  "Surname": "Rocket",
  "Email": "jrocket@example.com",
  "Role": [ "Manager", "Project Administrator" ]
}
```

# php 笔记

  1. const 声明常量
  2. public 公有属性或方法 普通原型方法
  3. static 静态方法 静态的数据是存在 内存中
  4. private 私有类型 只能在该类中使用
  5. final 不能被子类所继承 不能被子类的方法覆盖
  6. protected 受保护类型 (在子类中可以通过self:: 或 parent:: 来调用, 在实例中不能通过$obj-> 来调用)

# tp3.2

  1. M('User')->add($arr); 新增一条纪录
  2. M('User')->where($w_arr)->find(); 根据条件查询一条纪录
  3. M('User')->where($w_arr)->save($arr); 根据条件查询一条纪录 并修改
  4. $this->ajaxReturn($arr,'json'); ajax 返回json 数据

    tp3.2 单字母函数

      A函数: 用于实例化Action 格式：[项目://][分组/]模块
      /**
       * A函数用于实例化Action 格式：[项目://][分组/]模块
       * @param string $name Action资源地址
       * @param string $layer 控制层名称
       * @param boolean $common 是否公共目录
       * @return Action|false
       */
      A($name,$layer='',$common=false)

      B函数: 执行某个行为
      /**
       * 执行某个行为
       * @param string $name 行为名称
       * @param Mixed $params 传入的参数
       * @return void
       */
      B($name, &$params=NULL)

      C函数: 获取和设置配置参数 支持批量定义
      /**
       * 获取和设置配置参数 支持批量定义
       * @param string|array $name 配置变量
       * @param mixed $value 配置值
       * @return mixed
       */
      C($name=null, $value=null)

      D函数: 用于实例化Model 格式 项目://分组/模块
      /**
       * D函数用于实例化Model 格式 项目://分组/模块
       * @param string $name Model资源地址
       * @param string $layer 业务层名称
       * @return Model
       */
      D($name='',$layer='')

      F函数: 快速文件数据读取和保存 针对简单类型数据 字符串、数组
      /**
       * 快速文件数据读取和保存 针对简单类型数据 字符串、数组
       * @param string $name 缓存名称
       * @param mixed $value 缓存值
       * @param string $path 缓存路径
       * @return mixed
       */
      F($name, $value='', $path=DATA_PATH)

      G函数: 记录和统计时间（微秒）和内存使用情况
      /**
       * 记录和统计时间（微秒）和内存使用情况
       * 使用方法:
       * <code>
       * G('begin'); // 记录开始标记位
       * // ... 区间运行代码
       * G('end'); // 记录结束标签位
       * echo G('begin','end',6); // 统计区间运行时间 精确到小数后6位
       * echo G('begin','end','m'); // 统计区间内存使用情况
       * 如果end标记位没有定义，则会自动以当前作为标记位
       * 其中统计内存使用需要 MEMORY_LIMIT_ON 常量为true才有效
       * </code>
       * @param string $start 开始标签
       * @param string $end 结束标签
       * @param integer|string $dec 小数位或者m
       * @return mixed
       */
      G($start,$end='',$dec=4)

      I函数: 获取输入参数 支持过滤和默认值
      /**
       * 获取输入参数 支持过滤和默认值
       * 使用方法:
       * <code>
       * I('id',0); 获取id参数 自动判断get或者post
       * I('post.name','','htmlspecialchars'); 获取$_POST['name']
       * I('get.'); 获取$_GET
       * </code>
       * @param string $name 变量的名称 支持指定类型
       * @param mixed $default 不存在的时候默认值
       * @param mixed $filter 参数过滤方法
       * @return mixed
       */
      I($name,$default='',$filter=null)

      L函数: 获取和设置语言定义(不区分大小写)
      /**
       * 获取和设置语言定义(不区分大小写)
       * @param string|array $name 语言变量
       * @param string $value 语言值
       * @return mixed
       */
      L($name=null, $value=null)

      M函数: 用于实例化一个没有模型文件的Model
      /**
       * M函数用于实例化一个没有模型文件的Model
       * @param string $name Model名称 支持指定基础模型 例如 MongoModel:User
       * @param string $tablePrefix 表前缀
       * @param mixed $connection 数据库连接信息
       * @return Model
       */
      M($name='', $tablePrefix='',$connection='')

      N函数: 设置和获取统计数据
      /**
       * 设置和获取统计数据
       * 使用方法:
       * <code>
       * N('db',1); // 记录数据库操作次数
       * N('read',1); // 记录读取次数
       * echo N('db'); // 获取当前页面数据库的所有操作次数
       * echo N('read'); // 获取当前页面读取次数
       * </code>
       * @param string $key 标识位置
       * @param integer $step 步进值
       * @return mixed
       */
      N($key, $step=0,$save=false)

      R函数: 远程调用模块的操作方法 URL 参数格式 [项目://][分组/]模块/操作
      /**
       * 远程调用模块的操作方法 URL 参数格式 [项目://][分组/]模块/操作
       * @param string $url 调用地址
       * @param string|array $vars 调用参数 支持字符串和数组
       * @param string $layer 要调用的控制层名称
       * @return mixed
       */
      R($url,$vars=array(),$layer='')

      S函数: 缓存管理
      /**
       * 缓存管理
       * @param mixed $name 缓存名称，如果为数组表示进行缓存设置
       * @param mixed $value 缓存值
       * @param mixed $options 缓存参数
       * @return mixed
       */
      S($name,$value='',$options=null)

      T函数: 获取模版文件 格式 项目://分组@主题/模块/操作
      /**
       * 获取模版文件 格式 项目://分组@主题/模块/操作
       * @param string $name 模版资源地址
       * @param string $layer 视图层（目录）名称
       * @return string
       */
      T($template='',$layer='')

      U函数: URL组装 支持不同URL模式
      /**
       * URL组装 支持不同URL模式
       * @param string $url URL表达式，格式：'[分组/模块/操作#锚点@域名]?参数1=值1&参数2=值2...'
       * @param string|array $vars 传入的参数，支持数组和字符串
       * @param string $suffix 伪静态后缀，默认为true表示获取配置值
       * @param boolean $redirect 是否跳转，如果设置为true则表示跳转到该URL地址
       * @param boolean $domain 是否显示域名
       * @return string
       */
      U($url='',$vars='',$suffix=true,$redirect=false,$domain=false)

      W函数: 渲染输出Widget
      /**
       * 渲染输出Widget
       * @param string $name Widget名称
       * @param array $data 传入的参数
       * @param boolean $return 是否返回内容
       * @param string $path Widget所在路径
       * @return void
       */
      W($name, $data=array(), $return=false,$path='')

# tp5.0

  1. /thinkphp/public/index.php/index/index/index  index(模块名称)/index(index.php index 类)/index(方法) 默认路径
  2. Db::name('User')->insert($arr); 新增一条纪录
  3. Db::name('User')->where($w_arr)->find(); 根据条件查询一条纪录
  4. Db::name('User')->where($w_arr)->update($arr); 根据条件查询一条纪录 并修改
  5. return json($arr); ajax 返回json 数据

    tp5.0 助手函数:

      exception：抛出异常处理

          /**
           * 抛出异常处理
           * @param string    $msg  异常消息
           * @param integer   $code 异常代码 默认为0
           * @param string    $exception 异常类
           *
           * @throws Exception
           */
          exception($msg, $code = 0, $exception = '')


      debug：记录时间（微秒）和内存使用情况

          /**
           * 记录时间（微秒）和内存使用情况
           * @param string            $start 开始标签
           * @param string            $end 结束标签
           * @param integer|string    $dec 小数位 如果是m 表示统计内存占用
           * @return mixed
           */
          debug($start, $end = '', $dec = 6)


      lang：获取语言变量值

          /**
           * 获取语言变量值
           * @param string    $name 语言变量名
           * @param array     $vars 动态变量值
           * @param string    $lang 语言
           * @return mixed
           */
          lang($name, $vars = [], $lang = '')


      config：获取和设置配置参数

          /**
           * 获取和设置配置参数
           * @param string|array  $name 参数名
           * @param mixed         $value 参数值
           * @param string        $range 作用域
           * @return mixed
           */
          config($name = '', $value = null, $range = '')


      input：获取输入数据，支持默认值和过滤

          /**
           * 获取输入数据 支持默认值和过滤
           * @param string    $key 获取的变量名
           * @param mixed     $default 默认值
           * @param string    $filter 过滤方法
           * @return mixed
           */
          input($key = '', $default = null, $filter = null)


      widget：渲染输出Widget

          /**
           * 渲染输出Widget
           * @param string    $name Widget名称
           * @param array     $data 传入的参数
           * @return mixed
           */
          widget($name, $data = [])


      model：实例化Model

          /**
           * 实例化Model
           * @param string    $name Model名称
           * @param string    $layer 业务层名称
           * @param bool      $appendSuffix 是否添加类名后缀
           * @return \think\Model
           */
          model($name = '', $layer = 'model', $appendSuffix = false)


      validate：实例化验证器

          /**
           * 实例化验证器
           * @param string    $name 验证器名称
           * @param string    $layer 业务层名称
           * @param bool      $appendSuffix 是否添加类名后缀
           * @return \think\Validate
           */
          validate($name = '', $layer = 'validate', $appendSuffix = false)


      db：实例化数据库类

          /**
           * 实例化数据库类
           * @param string        $name 操作的数据表名称（不含前缀）
           * @param array|string  $config 数据库配置参数
           * @param bool          $force 是否强制重新连接
           * @return \think\db\Query
           */
          db($name = '', $config = [], $force = true)


      controller：实例化控制器，格式：[模块/]控制器

          /**
           * 实例化控制器 格式：[模块/]控制器
           * @param string    $name 资源地址
           * @param string    $layer 控制层名称
           * @param bool      $appendSuffix 是否添加类名后缀
           * @return \think\Controller
           */
          controller($name, $layer = 'controller', $appendSuffix = false)


      action：调用模块的操作方法，参数格式：[模块/控制器/]操作

          /**
           * 调用模块的操作方法 参数格式 [模块/控制器/]操作
           * @param string        $url 调用地址
           * @param string|array  $vars 调用参数 支持字符串和数组
           * @param string        $layer 要调用的控制层名称
           * @param bool          $appendSuffix 是否添加类名后缀
           * @return mixed
           */
          action($url, $vars = [], $layer = 'controller', $appendSuffix = false)


      import：导入所需的类库，同java的Import，本函数有缓存功能

          /**
           * 导入所需的类库 同java的Import 本函数有缓存功能
           * @param string    $class 类库命名空间字符串
           * @param string    $baseUrl 起始路径
           * @param string    $ext 导入的文件扩展名
           * @return boolean
           */
           import($class, $baseUrl = '', $ext = EXT)


      vendor：快速导入第三方框架类库，所有第三方框架的类库文件统一放到系统的Vendor目录下面

          /**
           * 快速导入第三方框架类库 所有第三方框架的类库文件统一放到 系统的Vendor目录下面
           * @param string    $class 类库
           * @param string    $ext 类库后缀
           * @return boolean
           */
          vendor($class, $ext = EXT)


      dump：浏览器友好的变量输出

          /**
           * 浏览器友好的变量输出
           * @param mixed     $var 变量
           * @param boolean   $echo 是否输出 默认为true 如果为false 则返回输出字符串
           * @param string    $label 标签 默认为空
           * @return void|string
           */
          dump($var, $echo = true, $label = null)


      url：Url生成

          /**
           * Url生成
           * @param string        $url 路由地址
           * @param string|array  $vars 变量
           * @param bool|string   $suffix 生成的URL后缀
           * @param bool|string   $domain 域名
           * @return string
           */
          url($url = '', $vars = '', $suffix = true, $domain = false)


      session：Session管理

          /**
           * Session管理
           * @param string|array  $name session名称，如果为数组表示进行session设置
           * @param mixed         $value session值
           * @param string        $prefix 前缀
           * @return mixed
           */
          session($name, $value = '', $prefix = null)


      cookie：Cookie管理

          /**
           * Cookie管理
           * @param string|array  $name cookie名称，如果为数组表示进行cookie设置
           * @param mixed         $value cookie值
           * @param mixed         $option 参数
           * @return mixed
           */
          cookie($name, $value = '', $option = null)


      cache：缓存管理

          /**
           * 缓存管理
           * @param mixed     $name 缓存名称，如果为数组表示进行缓存设置
           * @param mixed     $value 缓存值
           * @param mixed     $options 缓存参数
           * @param string    $tag 缓存标签
           * @return mixed
           */
          cache($name, $value = '', $options = null, $tag = null)


      trace：记录日志信息

          /**
           * 记录日志信息
           * @param mixed     $log log信息 支持字符串和数组
           * @param string    $level 日志级别
           * @return void|array
           */
          trace($log = '[think]', $level = 'log')


      request：获取当前Request对象实例

          /**
           * 获取当前Request对象实例
           * @return Request
           */
          request()


      response：创建普通Response对象实例

          /**
           * 创建普通 Response 对象实例
           * @param mixed      $data   输出数据
           * @param int|string $code   状态码
           * @param array      $header 头信息
           * @param string     $type
           * @return Response
           */
          response($data = [], $code = 200, $header = [], $type = 'html')


      view：渲染模板输出

          /**
           * 渲染模板输出
           * @param string    $template 模板文件
           * @param array     $vars 模板变量
           * @param array     $replace 模板替换
           * @param integer   $code 状态码
           * @return \think\response\View
           */
          view($template = '', $vars = [], $replace = [], $code = 200)


      json：获取Json对象实例

          /**
           * 获取\think\response\Json对象实例
           * @param mixed   $data 返回的数据
           * @param integer $code 状态码
           * @param array   $header 头部
           * @param array   $options 参数
           * @return \think\response\Json
           */
          json($data = [], $code = 200, $header = [], $options = [])


      jsonp：获取Jsonp对象实例

          /**
           * 获取\think\response\Jsonp对象实例
           * @param mixed   $data    返回的数据
           * @param integer $code    状态码
           * @param array   $header 头部
           * @param array   $options 参数
           * @return \think\response\Jsonp
           */
          jsonp($data = [], $code = 200, $header = [], $options = [])


      xml：获取xml对象实例

          /**
           * 获取\think\response\Xml对象实例
           * @param mixed   $data    返回的数据
           * @param integer $code    状态码
           * @param array   $header  头部
           * @param array   $options 参数
           * @return \think\response\Xml
           */
          xml($data = [], $code = 200, $header = [], $options = [])


      redirect：获取Redirect对象实例

          /**
           * 获取\think\response\Redirect对象实例
           * @param mixed         $url 重定向地址 支持Url::build方法的地址
           * @param array|integer $params 额外参数
           * @param integer       $code 状态码
           * @return \think\response\Redirect
           */
          redirect($url = [], $params = [], $code = 302)


      abort：抛出HTTP异常

          /**
           * 抛出HTTP异常
           * @param integer|Response      $code 状态码 或者 Response对象实例
           * @param string                $message 错误信息
           * @param array                 $header 参数
           */
          abort($code, $message = null, $header = [])


      halt：调试变量并且中断输出

          /**
           * 调试变量并且中断输出
           * @param mixed      $var 调试变量或者信息
           */
          halt($var)


      token：生成表单令牌

          /**
           * 生成表单令牌
           * @param string $name 令牌名称
           * @param mixed  $type 令牌生成方法
           * @return string
           */
          token($name = '__token__', $type = 'md5')
