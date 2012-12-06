## 环境

为 Linux / PHP 设计，推荐采用 NginX / PHP-FPM 提供生产服务。

_【注意】 请确保搭载此程序的服务器已在墙外！_

## 依赖

> php5 @5.3.x

> php5-curl

## 安装

假定程序会部署到默认的`/var/www`目录。

### A. 下载

```shell
cd /var/www
git clone git://github.com/snakevil/szen.pac.git szen.pac.git
```

### B. 权限调整

```shell
cd /var/www/szen.pac.git/src
chmod -R g+w,g+s var
```

_【注意】使`www-data`帐号具备`var`目录的写权限。_

### C. 创建定时器

```shell
sudo ln -s /var/www/szen.pac.git/src/etc/cron.d/szen.pac /etc/cron.d/
```

_【注意】如果部署目录并非`/var/www`，那么还需要对`src/etc/cron.d/szen.pac`任务
做相应的修改。_

### D. 创建 NginX 站点

```shell
sudo ln -s /var/www/szen.pac.git/src/etc/nginx/szen.pac.conf /etc/nginx/sites-enabled/
sudo nginx -t && sudo nginx -s reload
```

_【注意】如果部署目录并非`/var/www`，那么还需要对`src/etc/nginx/szen.pac.conf`
配置文件做相应的修改。_

_【警告】如果`NginX`站点配置文件目录不再是`/etc/nginx/sites-enabled`，请调整执行
指令。_

## 定制

### A. 添加自己的GFWList规则

```shell
vim /var/www/szen.pac.git/src/etc/gfwlist.txt
```

_【提示】 如对该文件格式存在疑问，请阅读同目录下的`gfwlist.txt-sample`文件。_

### B. 更改PAC的访问地址

1. 编辑`src/etc/nginx/szen.pac.conf`配置文件；
2. 修改`location ~ ^/szen.\*\.js$`中的`szen`单词为任意期望的内容；
3. `sudo nginx -t && sudo nginx -s reload`。

<!-- vim: se ft=markdown fenc=utf-8 ff=unix tw=80 noet nonu: -->
