window.debug = true;

// -----------------------Date 扩展----------------------------
  Date.prototype.fn_Format = function (fmt) {
      var o = {
          "M+": this.getMonth() + 1, //月份
          "d+": this.getDate(), //日
          "h+": this.getHours(), //小时
          "m+": this.getMinutes(), //分
          "s+": this.getSeconds(), //秒
          "q+": Math.floor((this.getMonth() + 3) / 3), //季度
          "S": this.getMilliseconds() //毫秒
      };
      if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
      for (var k in o)
      if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
      return fmt;
  }

  // new Date(_yyyy,mm - 1,_dd) 月 份从0 开始
  // var date = new Date();//获取当前时间
  // date.setDate(date.getDate()-7);//设置天数 -7 天
  // var time = date.Format("yyyy,MM,dd");

// -----------------------Array 扩展----------------------------
  Array.prototype.fn_isArray = function () {
      if (this instanceof Array) {
        return true;
      }
      return false;
  }

// -----------------------tpl 扩展----------------------------
  // replace [过滤 str == undefined 情况] 依赖String扩展
  // get_tplKey [取出 {{name}} 中 name 字符串] 依赖String扩展
  var render = function (str,obj) {
      var _arr = str.match(/\{\{([a-zA-Z0-9_])+\}\}/g);
      var k,v;
      for (var i = 0; i < _arr.length; i++) {
          k = _arr[i];
          v = obj[k.get_tplKey()];
          str = str.replace(k,v);
      }
      return str;
  }
// -----------------------String 扩展----------------------------
  // 过滤 str == undefined 情况
  var _replace = String.prototype.replace;
  String.prototype.replace = function(Reg,str) {
      var _this = this;
      if(typeof str != 'undefined'){
          return _replace.call(_this,Reg,str+'');
      }else{
          return _replace.call(_this,Reg,'');
      }
  };
  // 取出 {{name}} 中 name 字符串
  String.prototype.get_tplKey = function() {
      var _this = this;
      _this = _this.substring(2,_this.length - 2)
      return _this;
  };
// 分割数组
function formatArray(arr,n) {
  var n = n || 7;

  var result = [];
  for(var i=0;i<arr.length;i+=n){
     result.push(arr.slice(i,i+n));
  }
  return result;
}
// -------------------------------ajax方法----------------------------------
var Ajax = function() {
    var that = this;
    //创建异步请求对象方法
    that.createXHR = function() {
        if(window.XMLHttpRequest) { //IE7+、Firefox、Opera、Chrome 和Safari
            return new XMLHttpRequest();
        } else if(window.ActiveXObject) { //IE6 及以下
            var versions = ['MSXML2.XMLHttp', 'Microsoft.XMLHTTP'];
            for(var i = 0, len = versions.length; i < len; i++) {
                try {
                    return new ActiveXObject(version[i]);
                    break;
                } catch(e) {
                    //跳过
                }
            }
        } else {
            throw new Error('浏览器不支持XHR对象！');
        }
    }
    //初始化数据方法
    that.init = function(obj) {
        //初始化数据
        var objAdapter = {
                method: 'get',
                data: {},
                success: function() {},
                complete: function() {},
                error: function(s) {
                    alert('status:' + s + 'error!');
                },
                async: true
            }
            //通过使用JS随机字符串解决IE浏览器第二次默认获取缓存的问题
        that.url = obj.url + '?rand=' + Math.random();
        that.method = obj.method || objAdapter.method;
        that.data = that.params(obj.data) || that.params(objAdapter.data);
        that.async = obj.async || objAdapter.async;
        that.complete = obj.complete || objAdapter.complete;
        that.success = obj.success || objAdapter.success;
        that.error = obj.error || objAdapter.error;
    }
    //ajax异步调用
    that.ajax = function(obj) {
        that.method = obj.method || 'get';
        if(obj.method === 'post'){
            that.post(obj);
        }else{
            that.get(obj);
        }
    }
    //post方法
    that.post = function(obj) {
        var xhr = that.createXHR(); //创建XHR对象
        that.init(obj);
        that.method='post';
        if(that.async === true) { //true表示异步，false表示同步
            //使用异步调用的时候，需要触发readystatechange 事件
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4) { //判断对象的状态是否交互完成
                    that.callback(obj,this); //回调
                }
            };
        }
        //在使用XHR对象时，必须先调用open()方法，
        //它接受三个参数：请求类型(get、post)、请求的URL和表示是否异步。
        xhr.open(that.method, that.url, that.async);
        //post方式需要自己设置http的请求头，来模仿表单提交。
        //放在open方法之后，send方法之前。
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(that.data); //post方式将数据放在send()方法里
        if(that.async === false) { //同步
            that.callback(obj,this); //回调
        }
    };
    //get方法
    that.get = function(obj) {
        var xhr = that.createXHR(); //创建XHR对象
        that.init(obj);
        if(that.async === true) { //true表示异步，false表示同步
            //使用异步调用的时候，需要触发readystatechange 事件
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4) { //判断对象的状态是否交互完成
                    that.callback(obj,this); //回调
                }
            };
        }
        //若是GET请求，则将数据加到url后面
        that.url += that.url.indexOf('?') == -1 ? '?' + that.data : '&' + that.data;
        //在使用XHR对象时，必须先调用open()方法，
        //它接受三个参数：请求类型(get、post)、请求的URL和表示是否异步。
        xhr.open(that.method, that.url, that.async);
        xhr.send(null); //get方式则填null
        if(that.async === false) { //同步
            that.callback(obj,this); //回调
        }
    }
    //请求成功后，回调方法
    that.callback = function(obj,xhr) {
            if(xhr.status == 200) { //判断http的交互是否成功，200表示成功
                obj.success(xhr.responseText); //回调传递参数
            } else {
                alert('获取数据错误！错误代号：' + xhr.status + '，错误信息：' + xhr.statusText);
            }
        }
    //数据转换
    that.params = function(data) {
        var arr = [];
        for(var i in data) {
            //特殊字符传参产生的问题可以使用encodeURIComponent()进行编码处理
            arr.push(encodeURIComponent(i) + '=' + encodeURIComponent(data[i]));
        }
        return arr.join('&');
    }
    return {
        post : that.post,
        get : that.get,
        ajax : that.ajax
    }
}
// -------------------------------JQ ajax方法----------------------------------
var _post = function (url,data,callBack,err_fn) {
  if(!url){
    err_fn && err_fn();
    return;
  }
  $.ajax({
      type : "POST",
      url : url,
      data : data,
      dataType: 'json',
      success : function(res) {
          callBack && callBack(res);
      },
      error: function(err) {
          err_fn && err_fn(err);
      }
  });
}
var _get = function (url,data,callBack,err_fn) {
  if(!url){
    err_fn && err_fn();
    return;
  }
  $.ajax({
      type : "GET",
      url : url,
      data : data,
      dataType: 'json',
      success : function(res) {
          callBack && callBack(res);
      },
      error: function(err) {
          err_fn && err_fn(err);
      }
  });
}

// -------------------------------alert debug----------------------------------
  window.debug && (window._log = window.console.log,window.console.log = function () {
    return;
  });
  window.debug && (window._err =  function (str) {
    throw str;
  });
  // alert('小于等于5个字',400);
  // alert('大大咧咧，口无遮拦，祸从口出');
  (function () {
    function _alert(_) {
      window.alert.is_alert = true;
      clearTimeout(window.alert._time);
      _.T = _.T || 1400; //显示时间
      var w = _.msg.length * 13 + 12;
      var l = w/2;
      var _dom = document.getElementById('alert_id');
      _dom && _dom.parentNode.removeChild(_dom);

      var container = document.createElement('div');
      container.innerHTML = '<div id="alert_id" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;position: fixed;z-index: 999;left: 50%;top: 50%;margin-top: -15px;margin-left: -'+l+'px;line-height: 30px;text-align: center;padding: 0 6px;width: '+w+'px;border-radius: 5px;background: rgba(0,0,0,.35);font-size: 12px;color: #fff;">'+_.msg+'</div>';
      _dom = container.childNodes[0];
      document.body.appendChild(_dom);

      window.alert._time = setTimeout(function () {
        _dom = document.getElementById('alert_id');
        _dom.parentNode.removeChild(_dom);
        window.alert.is_alert = false;
        alert_init();
      },_.T);
    }
    function alert_init() {
      var _ = window.alert_arr.shift();
      _ && _alert(_)
    }
    window.alert_arr = [];
    window.alert = function (msg,T) {
      window.alert_arr.push({
        msg: msg,
        T: T
      });
      !window.alert.is_alert && alert_init();
    }
  }());
// -------------------------------DOM-操作----------------------------------
function createDom(tpl) {
  var container = document.createElement('div');
  container.innerHTML = tpl;
  return container.childNodes[0];
};

function addEvent(el, type, fn, capture) {
  el.addEventListener(type, fn, !!capture);
};

function removeEvent(el, type, fn, capture) {
  el.removeEventListener(type, fn, !!capture);
};

function hasClass(el, className) {
  var reg = new RegExp('(^|\\s)' + className + '(\\s|$)');
  return reg.test(el.className);
};

function addClass(el, className) {
  if (hasClass(el, className)) {
    return;
  }

  var newClass = el.className.split(' ');
  newClass.push(className);
  el.className = newClass.join(' ');
};

function removeClass(el, className) {
  if (!hasClass(el, className)) {
    return;
  }

  var reg = new RegExp('(^|\\s)' + className + '(\\s|$)', 'g');
  el.className = el.className.replace(reg, ' ');
};

