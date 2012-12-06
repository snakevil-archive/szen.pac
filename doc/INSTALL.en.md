## ENVIRONMENT

DESIGNED for Linux / PHP. NginX / PHP-FPM RECOMMENDED!

_NOTICE An abroad server is REQUIRED!_

## DEPENDENCIES

> php5 @5.3.x

> php5-curl

## INSTALLATION

Expected the program would be distributed to the folder `/var/www` as default.

### A. Download

```shell
cd /var/www
git clone git://github.com/snakevil/szen.pac.git szen.pac.git
```

### B. Grant Permissions

```shell
cd /var/www/szen.pac.git/src
chmod -R g+w,g+s var
```

_NOTICE To allow `www-data` account writable into the `var` folder._

### C. Make New Cron Job

```shell
sudo ln -s /var/www/szen.pac.git/src/etc/cron.d/szen.pac /etc/cron.d/
```

_NOTICE Please modify the cron task `src/etc/cron.d/szen.pac` for a different
distribution folder rather than `/var/www`._

### D. Build NginX Server

```shell
sudo ln -s /var/www/szen.pac.git/src/etc/nginx/szen.pac.conf /etc/nginx/sites-enabled/
sudo nginx -t && sudo nginx -s reload
```

_NOTICE Please modify the configuration `src/etc/nginx/szen.pac.conf` for a
different distribution folder rather than `/var/www`._

_WARNING Please change the execution commands while `NginX` servers
configuration folders been moved from `/etc/nginx/sites-enabled` to any other
places._

## CUSTOMIZATION

### A. Add Own GFWList Rules

```shell
vim /var/www/szen.pac.git/src/etc/gfwlist.txt
```

_TIP For more information about the forms of rules, please read
`gfwlist.txt-sample`._

### B. Change PAC Address

1. Edit the configuration `src/etc/nginx/szen.pac.conf`,
2. Change the `szen` in `location ~ ^/szen.\*\.js$` to any phrase as you like,
3. `sudo nginx -t && sudo nginx -s reload`.

<!-- vim: se ft=markdown fenc=utf-8 ff=unix tw=80 noet nonu: -->
