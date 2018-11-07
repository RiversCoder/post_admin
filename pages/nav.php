<ul class="layui-nav" lay-filter="">
  <li class="layui-nav-item layui-this"><a href="">首页</a></li>
  <li class="layui-nav-item">
    <a href="javascript:;">数据管理</a>
    <dl class="layui-nav-child"> <!-- 二级菜单 -->
      <dd><a href="">新增数据</a></dd>
      <dd><a href="">修改数据</a></dd>
      <dd><a href="">查看数据</a></dd>
    </dl>
  </li>
  <li class="layui-nav-item">
    <a href="">个人中心<span class="layui-badge-dot"></span></a>
  </li>
  <li class="layui-nav-item">
    <a href=""><img src="//t.cn/RCzsdCq" class="layui-nav-img">我</a>
    <dl class="layui-nav-child">
      <dd><a href="javascript:;">修改信息</a></dd>
      <dd><a href="javascript:;">安全管理</a></dd>
      <dd><a href="javascript:;">退了</a></dd>
    </dl>
  </li>
</ul>

<script>
    !function(){
        //注意：导航 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
            var element = layui.element;
            
        //…
        });
    }()
</script>