## 环境

为 Linux / PHP 设计，推荐采用 NginX / PHP-FPM 提供生产服务。

**【注意】** 请确保搭载此程序的服务器已在墙外！

## 依赖

> php5 @5.3.x

> php5-curl

## 安装

### A. 下载

```shell
git clone git://github.com/snakevil/szen.pac.git
```

### B. 创建定时器

```shell
crontab -e
```

> */30 * * * * *『SZEN.PAC 目录路径』*/bin/update >> *『SZEN.PAC 目录路径』*/var/update.log 2>&1

**【注意】** 建议执行间隔时间设置为30分钟，以确保 GFWList 的实时性。

### C. 创建站点目录

```shell
vim *『NginX 配置目录路径』*/nginx.conf
sudo nginx -t && sudo nginx -s reload
```

在相应的站点`server{}`块内添加：

> include *『SZEN.PAC 目录路径』*/etc/nginx.conf-sample;

## 定制

### A. 添加自己的GFWList规则

```shell
vim *『SZEN.PAC 目录路径』*/etc/gfwlist.txt
```

【提示】 如对该文件格式存在疑问，请阅读同目录下的`gfwlist.txt-sample`文件。

### B. 更改PAC的访问地址

1. 将`『SZEN.PAC 目录路径』/etc/nginx.conf-sample`文件内容复制到`『NginX 配置
   目录路径』/nginx.conf`文件中；
2. 修改`location ~ ^/szen.*\.pac$`中的`szen`单词为任意期望的内容；
3. `sudo nginx -t && sudo nginx -s reload`。

<!-- vim: se ft=markdown fenc=utf-8 ff=unix tw=80 noet nonu: -->
