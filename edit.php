
    <!-- 头部 -->
    <?php  include_once('pages/header.php');  ?>

    <!-- 导航 -->
    <?php  include_once('pages/nav.php');  ?>
                    


    <!-- 返回列表按钮 -->
    <section class="add_data_btn">
        <a href="./index.php">
            <button class="layui-btn">
                返回列表
            </button>
        </a>
    </section>

    <section class="form_box">
        <form class="layui-form" method="POST" lay-filter="my-form">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">时间</label>
                <div class="layui-input-block">
                    <input type="text" name="time" required  lay-verify="required" placeholder="请输入时间" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图片</label>
                <div class="layui-input-block">
                    <input type="text" name="imgText"  placeholder="请输入封面图片名称" value="cover.jpg" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">音乐名称</label>
                <div class="layui-input-block">
                    <input type="text" name="musicName"  placeholder="请输入封面音乐名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">音乐链接</label>
                <div class="layui-input-block">
                    <input type="text" name="musicLink"  placeholder="请输入封面音乐链接" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-tab layui-tab-box">
                <ul class="layui-tab-title ltt-box">
                    <span class="layui-btn layui-btn-xs add-paragh-btn">增加段落</span>
                    <li class="layui-this ltt-template">段落1</li>
                    <!-- <li>段落2</li> -->
                </ul>
                <div class="layui-tab-content ltc-box" >
                    
                    <!-- ITEM  -->
                    <div class="layui-tab-item layui-show ltc-template">
                        <div class="layui-form-item">
                            <label class="layui-form-label">标题1</label>
                            <div class="layui-input-block">
                                <input type="text" name="substance-title1" required  lay-verify="required" placeholder="请输入标题1" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">图片1</label>
                            <div class="layui-input-block">
                                <input type="text" name="substance-image1"  value='[{"index": "0", "name": "post_backup.jpg"}]' placeholder="请输入图片信息1" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">段落1</label>
                            <div class="layui-input-block">
                                <textarea name="substance-content1" placeholder="请输入内容1 （用分号;隔开）" class="layui-textarea" ></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="layui-tab-item">内容2</div> -->
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">底部信息</label>
                <div class="layui-input-block">
                    <input type="text" name="message" placeholder="请输入底部信息" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>

        </form>
    </section>
        
    <script>

        //Demo
        layui.use('form', function(){
            var form = layui.form;
            
            //监听提交
            form.on('submit(formDemo)', function(data){
                
                //layer.msg(JSON.stringify(data.field));

                var dataTemplate = JSON.parse(JSON.stringify(data.field));
                var substance = getSubstance(dataTemplate);
                var format = getJson(dataTemplate,substance);
                
                //修改文章
                Post.updatePostById(<?php echo $_GET['id']; ?>,format,(res) =>{
                    console.log(res);
                    if(res.status == 200 && res.statusText.toLowerCase() == 'ok'){
                        layer.msg('修改成功！');
                        setTimeout(() => {
                            window.location.href="./index.php"
                        }, 2000);
                    }
                });

                return false;
            });



        });

        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
            var element = layui.element;
            
            //…
        });

        //点击增加段落
        
        $('.add-paragh-btn').on('click',() => {
            let index = $('.layui-tab-item').length + 1 ;
            addHTMLTab(index);
        });

    </script>


    <script>

        //1. 初始化数据

        initData(<?php echo $_GET['id']; ?>);


        /*  初始化获取数据 */
        function initData(id){
            Post.getPostById(id,(res)=>{
                showBackForm(res);
            });
        }


        /* 回显数据 */
        function showBackForm(data){
            // 基本属性
            var basic = {
                imgText: data.content.img,
                message: data.content.message,
                musicName: data.content.ctype&&data.content.ctype.name,
                musicLink: data.content.ctype&&data.content.ctype.src,
                time: data.time,
                title: data.title 
            };

            // 段落属性
            var substance = data.content.substance;
            var substance_input = {};
            substance.forEach((v,index) => {
                substance_input['substance-content'+(index+1)] = v.paragraph.join(';');
                substance_input['substance-title'+(index+1)] = v.title;
                substance_input['substance-image'+(index+1)] = JSON.stringify(v.img);
                
                if(index >= 1){
                    //创建段落表单标签
                    addHTMLTab(index+1);
                }
            });
            

            // 基本属性
            var formData = Object.assign({},basic,substance_input);
            layui.form.val("my-form", formData);
        }

        /* 获取数据结构 */
        function getJson(dataTemplate,substanceArr){
            var format = {
                title: dataTemplate.title,
                author:'',
                intros:'',
                time: dataTemplate.time,
                content:{
                    type:'imgText',
                    img: dataTemplate.imgText,
                    ctype:{
                        value: 'music',
                        name: dataTemplate.musicName,
                        src: dataTemplate.musicLink
                    },
                    substance: substanceArr,
                    message: dataTemplate.message
                }
            }; 
            return format;
        }


        /* 构造段落 */
        function getSubstance(dataTemplate){
            let subIndex = 1;
            let substance = [];
            //debugger;
            while(dataTemplate['substance-content'+subIndex]){
                substance.push({
                    title: dataTemplate['substance-title'+subIndex],
                    paragraph: dataTemplate['substance-content'+subIndex].split(';'),
                    img: JSON.parse(dataTemplate['substance-image'+subIndex])
                });
                subIndex++;
            }
            return substance;
        }
        
        

        /* 增加段落 */
        function addHTMLTab(index){
            $('.ltt-box').append('<li>段落'+ (index) +'</li>');
            $('.ltc-box').append('<div class="layui-tab-item" style="color:rgb('+Math.random()*255+','+Math.random()*255+','+Math.random()*255+');">'+ `<div class="layui-form-item">
                    <label class="layui-form-label">标题${index}</label>
                    <div class="layui-input-block">
                        <input type="text" name="substance-title${index}" required  lay-verify="required" placeholder="请输入标题${index}" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片${index}</label>
                    <div class="layui-input-block">
                        <input type="text" name="substance-image${index}"  value='[{"index": "0", "name": "post_backup.jpg"}]'  placeholder="请输入图片信息${index}" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">段落${index}</label>
                    <div class="layui-input-block">
                        <textarea name="substance-content${index}" placeholder="请输入内容${index} （用分号;隔开）" class="layui-textarea" ></textarea>
                    </div>
                </div>` +'</div>');
        }
    </script>
</body>
</html>