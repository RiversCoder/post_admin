
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
        <form class="layui-form" method="POST">
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
                layer.msg(JSON.stringify(data.field));

                var dataTemplate = JSON.parse(JSON.stringify(data.field));
                var substance = getSubstance(dataTemplate);
                var format = getJson(dataTemplate,substance);
                
                Post.insertPost(format,(res) =>{
                    console.log(res);
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
        var index = 1 ;
        $('.add-paragh-btn').on('click',() => {
            addHTMLTab();
        });

    </script>


    <script>

        /*
        数据结构：
            var data = {
                imgText: "post11_1.jpg",
                message: "Json中文网致力于在中国推广Json,并提供相关的Json解析、验证、格式化、压缩、编辑器以及Json与XML相互转换等服务",
                music: "https://blog.csdn.net/WU5229485/article/details/83028007",
                substance-content: "哈哈哈哈;asxasxasxasxasxasxa;大太阳啦;",
                substance-content2: "2018-10-19 13:48:40;↵vue-cli项目路由懒加载的三种方式;↵闲唠嗑几句 今天公司有新的项目要开展，需要重新部署新的项目，所以说以前好多忘记的东西;又得重新捡起来一遍，配置路由的时候发现还是使用的普通的使用require懒加载路由",
                substance-content3: "asxasxasxa;134er2qdasd;asfd3 hfcedfasdasda;",
                substance-content4: "651655165165;54asd564asqwdasd5454dasd;45asd54asd54asd;asd5asd54asd54as",
                substance-image: "[{index: 0, name: 'post1_2.jpg'}]",
                substance-image2: "[{index: 0, name: 'post1_2.jpg'}]",
                substance-image3: "[{index: 0, name: 'post1_2.jpg'}]",
                substance-image4: "[{index: 0, name: 'post1_2.jpg'}]",
                substance-title: "123",
                substance-title2: "标题2",
                substance-title3: "asxasxas",
                substance-title4: "dasdasd",
                time: "2018/11/7",
                title: "我在晒太阳"
            }

        目标结构：

        var format = {
            title: data.title,
            author:'',
            intros:'',
            time: data.time,
            content:{
                type:'imgText',
                img: data.imgText,
                ctype:{
                    value: 'music',
                    name: data.musicName,
                    src: data.musicLink
                },
                substance:[{
                    title: '流年泛黄，是否还会想起312312',
                    paragraph: [
                        '一直想写一个故事，用清淡的笔墨，写流年花飞，写岁月蹉跎，还有爱情，那一段段一行行，有一天都会在流年似水中泛黄，唯有你的章节，是淡不开的笔墨，旖旎于我的字里行间，温柔着心底如水的情怀。',
                        '寂静的时光里，只有文字，是最好的陪伴，也只有文字，能让越来越模糊的过往，变得清晰。总有一天，关于你的记忆，会随着时间远走，到那个时候，如若，你看到这些已经发黄的字迹，还会不会将我，轻轻想起？你若安好，便是晴天，我一直记得。',
                        '心里，一直有一个梦，梦里有远山如黛，小桥流水，还有明媚笑颜的你。'
                    ],
                    img: null
                }],
                message: ''
            }
        };

        */
        var dataTemplate = {
                'imgText': "post11_1.jpg",
                'message': "Json中文网致力于在中国推广Json,并提供相关的Json解析、验证、格式化、压缩、编辑器以及Json与XML相互转换等服务",
                'musicName': "找太阳",
                'musicLink': "https://blog.csdn.net/WU5229485/article/details/83028007",
                'substance-content1': "哈哈哈哈;asxasxasxasxasxasxa;大太阳啦;",
                'substance-content2': "2018-10-19 13:48:40;↵vue-cli项目路由懒加载的三种方式;↵闲唠嗑几句 今天公司有新的项目要开展，需要重新部署新的项目，所以说以前好多忘记的东西;又得重新捡起来一遍，配置路由的时候发现还是使用的普通的使用require懒加载路由",
                'substance-content3': "asxasxasxa;134er2qdasd;asfd3 hfcedfasdasda;",
                'substance-content4': "651655165165;54asd564asqwdasd5454dasd;45asd54asd54asd;asd5asd54asd54as",
                'substance-image1': '[{"index": "0", "name": "post1_2.jpg"}]',
                'substance-image2': '[{"index": "0", "name": "post1_2.jpg"}]',
                'substance-image3': '[{"index": "0", "name": "post1_2.jpg"}]',
                'substance-image4': '[{"index": "0", "name": "post1_2.jpg"}]',
                'substance-title1': "123",
                'substance-title2': "标题2",
                'substance-title3': "asxasxas",
                'substance-title4': "dasdasd",
                'time': "2018/11/7",
                'title': "我在晒太阳"
        }


        
        //console.log(substance);
        
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
        function addHTMLTab(){
            $('.ltt-box').append('<li>段落'+ (++index) +'</li>');
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