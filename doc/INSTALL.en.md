## ENVIRONMENT

DESIGNED for Linux / PHP. NginX / PHP-FPM RECOMMENDED!

**NOTICE** An Abroad server is NECESSARY!

## DEPENDENCIES

> php5 @5.3.x

> php5-curl

## INSTALLATION

### A. Download

```shell
git clone git://github.com/snakevil/szen.pac.git
```

### B. Grant Permissions

```shell
mkdir -p *<SZEN.PAC Directory>*/var/cache
chmod -R g+w,g+s *<SZEN.PAC Directory>*/var
```

*TIP* To allow www-data account writing in `var` folder.

### C. Make New Cron Job

```shell
crontab -e
```

> */30 * * * * *<SZEN.PAC Directory>*/bin/update >> *<SZEN.PAC Directory>*/var/update.log 2>&1

**NOTICE** Its highly recommended to set the interval time to 30 minutes, for
the accuracy of GFWList.

### D. Serve Location

```shell
vim *<NginX Config Directory>*/nginx.conf
sudo nginx -t && sudo nginx -s reload
```

In the corresponding `server{}` block, add the following line:

> include *<SZEN.PAC Directory>*/etc/nginx.conf-sample;

## CUSTOMIZATION

### A. Add Own GFWList Rules

```shell
vim *<SZEN.PAC Directory>*/etc/gfwlist.txt
```

*TIP* For more information about the forms of rules, please read
`gfwlist.txt-sample`.

### B. Change PAC Address

1. Copy the content of `<SZEN.PAC Directory>/etc/nginx.conf-sample` into `<NginX
   Config Directory>/nginx.conf`
2. Change the `szen` in `location ~ ^/szen.*\.pac$` to any wished chars
3. `sudo nginx -t && sudo nginx -s reload`

<!-- vim: se ft=markdown fenc=utf-8 ff=unix tw=80 noet nonu: -->
