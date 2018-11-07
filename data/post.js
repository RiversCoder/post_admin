class Post{

    constructor(){
        
    }
    
    // 获取所有
    static getAllPosts(fn){
        //1. 获取所有数据
        fetch(Post.$domain).then(res => res.json()).then(res=>{
            fn&&fn(res);
        });
    }

    // 删除 By Id
    static deletePostById(id,fn){
        fetch(Post.$domain + '/'+id, 
            { method: "DELETE" }
        ).then(function(res) { 
            fn&&fn(res);
        });
    }

    // 插入一条记录
    static insertPost(data,fn){
        fetch(Post.$domain, 
            { method: "POST", headers: {'Content-Type': 'application/json' }, body: JSON.stringify(data)}
        ).then(function(res) { 
            fn&&fn(res);
        });
    }

    // 修改一条记录
    static updatePostById(id,data,fn){
        fetch(Post.$domain + '/'+id, 
            { method: "PUT", headers: {'Content-Type': 'application/json' }, body: JSON.stringify(data)}
        ).then(function(res) { 
            fn&&fn(res);
        });
    }
}

Post.$domain = 'http://localhost:8886/posts';