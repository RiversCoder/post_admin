
    <!-- 头部 -->
    <?php  include_once('pages/header.php');  ?>

    <!-- 导航 -->
    <?php  include_once('pages/nav.php');  ?>
                    
    <script>
        // function deleteById(id){
        //     Post.deletePostById(id,(res)=>{
        //         console.log(res);
        //     });
        // }
    </script>
    <!-- 标题信息 -->
    <!-- <blockquote class="layui-elem-quote">数据列表</blockquote> -->

    <!-- 添加数据按钮 -->
    <section class="add_data_btn">
        <a href="./add.php">
            <button class="layui-btn">
                <i class="layui-icon">&#xe608;</i> 添加数据
            </button>
        </a>
    </section>

    <!-- 表格信息 -->
    <table class="layui-table " lay-size="sm">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
            <tr>
                <th>编号</th>
                <th>标题</th>
                <th>时间</th>
                <th>媒体</th>
                <th>简介</th>
                <th>操作</th>
            </tr> 
        </thead>
        <tbody>

        <?php foreach($json_data as $data) :?>
            <tr>
                <td><?php echo $data->id; ?></td>
                <td><?php echo mb_substr($data->title,0,3); ?></td>
                <td><?php echo $data->time; ?></td>
                <td><?php 
                    echo (!empty($data->content->ctype->name) ? $data->content->ctype->name : '--');
                    echo !empty($data->content->ctype->name)&&empty($data->content->ctype->src) ? '  <span style="color:#000;">( 暂无资源 )</span>' : '';
                 ?> </td>
                <td><?php echo (strlen($data->content->substance[0]->paragraph[0]) > 50 ? mb_substr($data->content->substance[0]->paragraph[0],0,50).'...' : $data->content->substance[0]->paragraph[0] ); ?></td>
                <td>
                    <div class="layui-btn-group">
                        <button class="layui-btn layui-btn-sm" data-id="<?php echo $data->id; ?>">
                            <i class="layui-icon">&#xe642;</i>
                        </button>
                        <button class="layui-btn layui-btn-sm layui-btn-danger" data-id="<?php echo $data->id; ?>" onClick="deleteById(<?php echo $data->id; ?>)">
                            <i class="layui-icon">&#xe640;</i>
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>   

        </tbody>
    </table>
    
    

    <script>

        let $domin = 'http://localhost:8886/';

        //删除记录 by id
        function deleteById(id){
            Post.deletePostById(id,(res)=>{
                console.log(res);
            })
        }

        !function(){
            
           //删除记录 by id
           function deleteById(id){
                Post.deletePostById(id,(res)=>{
                    console.log(res);
                })
           }
            
        }();

    </script>
</body>
</html>