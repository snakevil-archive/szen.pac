	    o__ __o    _\__o__ __o/                               o__ __o        o           o__ __o
	   /v     v\        v    |/                              <|     v\      <|>         /v     v\
	  />       <\           /                                / \     <\     / \        />       <\
	 _\o____              o/      o__  __o   \o__ __o        \o/     o/   o/   \o    o/
	      \_\__o__       /v      /v      |>   |     |>        |__  _<|/  <|__ __|>  <|
	            \       />      />      //   / \   / \        |          /       \   \\
	  \         /     o/        \o    o/     \o/   \o/   o   <o>       o/         \o   \         /
	   o       o     /v          v\  /v __o   |     |   <|>   |       /v           v\   o       o
	   <\__ __/>    />  _\o__/_   <\/> __/>  / \   / \  < >  / \     />             <\  <\__ __/>

*A GFWList based, customize online PAC service.*

## BENEFITS

* Supports personal customize GFWList
	* Private sites to public GFWList
	* Crypted browsing to routing lines
	* Speeds up several sites through the proxy
* Supports "Remote DNS Lookup" for Chrome/Chromium and Firefox
	* For Socks5 proxy ONLY
* Reduces quota costing by PAC
	* [ROT47][ROT13]
		* 35% OFF from [AutoProxy2PAC][autoproxy2pac]
	* [DEFLATE][] / [Gzip][]
		* 75% OFF from uncompressed file

![Data Flow Diagram](https://github.com/snakevil/szen.pac/raw/master/share/doc/DFD.png)

## INSTALL

*For more details about environment, requirements and instructions, PLEASE read
**[INSTALL][]**.*

## USAGE

You SHOULD access the provided online PAC via "/szen\*.pac". For full syntax
information, PLEASE read forms in [Backus-Naur Form](#EBNF). For quick guide,
PLEASE read [samples](#Samples).

<a name="EBNF"></a>
### BACKUS-NAUR FORM

```
pac-uri	           =    "/szen" [ proxy-address ] [ socks-indicator ] ".pac"

proxy-address      =    "-" [ proxy-host ] [ proxy-port ]

proxy-host         =    1*3DIGIT "." 1*3DIGIT "." 1*3DIGIT "." 1*3DIGIT

subnet-ip          =    [ "." ] 1*3DIGIT [ "." 1*3DIGIT ]

proxy-port         =    [ ":" ] 4*5DIGIT

socks-indicator    =    "!" / "!s" / "!socks"
```

<a name="Samples"></a>
### SAMPLES

### a) SIMPLE

> /szen.pac

**HTTP** proxy from **127.0.0.1 : 8080** used;

> /szen-1234.pac
> /szen-:1234.pac

**HTTP** proxy from **127.0.0.1 : 1234** used;

> /szen-10.11.12.13.pac

**HTTP** proxy from **10.11.12.13 : 8080** used;

> /szen!.pac
> /szen!socks.pac

**SOCKS** proxy from **127.0.0.1 : 8080** used.

### b) COMPLEX

> /szen-10.11.12.13:1415!.pac

**SOCKS** proxy from **10.11.12.13 : 1415** used.

[ROT13]: http://en.wikipedia.org/wiki/ROT13
[autoproxy2pac]: https://autoproxy2pac.appspot.com/
[DEFLATE]: http://en.wikipedia.org/wiki/DEFLATE
[Gzip]: http://en.wikipedia.org/wiki/Gzip
[INSTALL]: https://github.com/snakevil/szen.pac/blob/master/INSTALL.en.md

<!-- vim: se ft=markdown fenc=utf-8 ff=unix tw=80 noet nonu: -->
