#OTC后台管理

## 功能清单

- 客户列表、详情
- 订单列表、订单确认/取消
- 提币申请


## 安装

1. 下载源码
    ```
    $ git clone git@gitlab.example.com:OTC/otc_cms.git
    ```
    如果你本地没有配hosts， 将域名改为IP 116.62.239.97
    ```
    $ git clone git@116.62.239.97:OTC/otc_cms.git
    ```

2. 安装依赖
    ```
    $ composer install
    $ yarn install
    ```
    
3. 执行migrations
    ```
    $ php artisan migrate
    ```
   
4. 初始化登录用户
    ``` 
    $ php artisan auth:init-roles
    $ php artisan user:create [email] [name] [password]
    $ php artisan auth:attach-role [userId] [roleName]
    ```
    
5. 配置NGINX
    ```
    server {
      listen 80;
      server_name otc-cms.dev;
      root /change/this/to/your/dir/public;
    
      location / {
        try_files $uri /index.php?$query_string;
      }
    
      location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
      }
    }
    ```

