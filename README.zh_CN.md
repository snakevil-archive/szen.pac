	    o__ __o    _\__o__ __o/                               o__ __o        o           o__ __o
	   /v     v\        v    |/                              <|     v\      <|>         /v     v\
	  />       <\           /                                / \     <\     / \        />       <\
	 _\o____              o/      o__  __o   \o__ __o        \o/     o/   o/   \o    o/
	      \_\__o__       /v      /v      |>   |     |>        |__  _<|/  <|__ __|>  <|
	            \       />      />      //   / \   / \        |          /       \   \\
	  \         /     o/        \o    o/     \o/   \o/   o   <o>       o/         \o   \         /
	   o       o     /v          v\  /v __o   |     |   <|>   |       /v           v\   o       o
	   <\__ __/>    />  _\o__/_   <\/> __/>  / \   / \  < >  / \     />             <\  <\__ __/>

*基于GFWList的、可定制的在线PAC服务程序。*

## 特色

* 支持自定义 GFWList 配置
	* 访问不想提交到公共 GFWList 的特殊站点
	* 对中继路由隐藏想访问的站点
	* 利用代理加速指定站点
* 完美支持 Chrome/Chromium 和 Firefox 的「远程DNS解析」功能
	* 仅限使用 Socks5 代理
* 极限压缩 PAC 占用的流量
	* 使用 [ROT47][ROT13] 算法加密
		* 比 [AutoProxy2PAC－全平台智能代理][autoproxy2pac] 节省近 35% 流量
	* 自动采用 [DEFLATE][] / [Gzip][] 压缩文件
		* 比未压缩时节省近 75% 流量

![数据流图](https://github.com/snakevil/szen.pac/raw/master/share/doc/DFD.png)

## 安装

*相关的环境、需求及步骤详情请查阅 **[安装][INSTALL]** 文档。*

## 使用

本程序所提供的在线 PAC 文件访问地址，始终符合 /szen\*.pac 的地址格式。具体的格
式规范，您可以通过阅读 [巴克斯范式](#EBNF) 以得到完整的理解；也可以直接对比 [范例
](#Samples) 快速拼装出符合您需要的地址。

<a name="EBNF"></a>
### 巴克斯范式

```
pac-uri	           =    "/szen" [ proxy-address ] [ socks-indicator ] ".pac"

proxy-address      =    "-" [ proxy-host ] [ proxy-port ]

proxy-host         =    1*3DIGIT "." 1*3DIGIT "." 1*3DIGIT "." 1*3DIGIT

subnet-ip          =    [ "." ] 1*3DIGIT [ "." 1*3DIGIT ]

proxy-port         =    [ ":" ] 4*5DIGIT

socks-indicator    =    "!" / "!s" / "!socks"
```

<a name="Samples"></a>
### 范例

### A. 简单范例

> /szen.pac

使用 **127.0.0.1 : 8080** 的 **HTTP** 代理；

> /szen-1234.pac
> /szen-:1234.pac

使用 **127.0.0.1 : 1234** 的 **HTTP** 代理；

> /szen-10.11.12.13.pac

使用 **10.11.12.13 : 8080** 的 **HTTP** 代理；

> /szen!.pac
> /szen!socks.pac

使用 **127.0.0.1 : 8080** 的 **SOCKS** 代理。

### B. 组合范例

> /szen-10.11.12.13:1415!.pac

使用 **10.11.12.13 : 1415** 的 **SOCKS** 代理。

[ROT13]: http://zh.wikipedia.org/wiki/ROT13
[autoproxy2pac]: https://autoproxy2pac.appspot.com/
[DEFLATE]: http://zh.wikipedia.org/wiki/DEFLATE
[Gzip]: http://zh.wikipedia.org/wiki/Gzip
[INSTALL]: https://github.com/snakevil/szen.pac/blob/master/INSTALL.zh_CN.md

<!-- vim: se ft=markdown fenc=utf-8 ff=unix tw=80 noet nonu: -->
