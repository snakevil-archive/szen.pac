<?php
/**
 * Serves online PAC script to popular user-agents.
 *
 * This file is part of SZEN.PAC.
 *
 * SZEN.PAC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SZEN.PAC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SZEN.PAC.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package   szen.pac
 * @author    Snakevil Zen <zsnakevil@gmail.com>
 * @copyright © 2012 snakevil.in
 * @license   http://www.gnu.org/licenses/gpl.html
 */

//error_reporting(0);

chdir(dirname(__FILE__) . '/..');

clearstatcache(true);

// Reads Last-Modified & ETag of prepared `proxy.pac'. {{{1

$f_pac = 'var/cache/proxy.pac';
$f_etag = 'var/cache/proxy.md5';

if (is_file($f_pac) && is_readable($f_pac))
    $i_time = filemtime($f_pac);
else
{
    header('Status: 503 Service Unavailable', true, 503);
    exit();
}

if (is_file($f_etag) && is_readable($f_etag))
    $s_etag = '"' . file_get_contents($f_etag) . '"';
else
    $s_etag = '';

// Quick responds to 304 requests. {{{1

if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH']))
{
    $b_304 = true;
    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) < $i_time)
        $b_304 = false;
    if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && ('' == $s_etag || $s_etag != $_SERVER['HTTP_IF_NONE_MATCH']))
        $b_304 = false;
    if ($b_304)
    {
        header('Status: 304 Not Modified', true, 304);
        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && '' != $s_etag)
            header('ETag: ' . $s_etag, true, 304);
        exit();
    }
}

// Recognizes requesting options. {{{1

$a_opts = array();
$s_opre = '@(?:/)[^\-/]+' .
    '(?:-(?:(\d{1,3}(?:\.\d{1,3}){3})|\.?((?:\d{1,3}\.)?\d{1,3}))?(?::?(\d{4,5}))?)?' .
    '(?:(!)(?:|s|socks))?\.pac$@U';
if (!preg_match($s_opre, parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $a_opts))
{
    header('Status: 400 Bad Request', true, 400);
    exit();
}
while (5 > count($a_opts))
    $a_opts[] = '';
array_shift($a_opts);
if ('' == $a_opts[0])
{
    if ('' == $a_opts[1])
        $a_opts[1] = '127.0.0.1';
    else
    {
        $a_opts[1] = explode('.', $a_opts[1]);
        $a_tmp = explode('.', $_SERVER['REMOTE_ADDR']);
        $a_opts[1] = implode('.', array_merge(array_slice($a_tmp, 0, 4 - count($a_opts[1])), $a_opts[1]));
        $a_tmp = NULL;
    }
}
else
    $a_opts[1] = $a_opts[0];
array_shift($a_opts);

// Formats options. {{{1

if ('' == $a_opts[1])
    $a_opts[1] = 8080;
$a_opts[2] = '!' == $a_opts[2] ? 'SOCKS' : 'PROXY';
$a_opts = array_combine(array('host', 'port', 'type'), $a_opts);

// Detects either `SOCKS' or `SOCKS5' for socks5 proxies. {{{1

if ('SOCKS' == $a_opts['type'])
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') ||
        strpos($_SERVER['HTTP_USER_AGENT'], ' Chromium/') ||
        strpos($_SERVER['HTTP_USER_AGENT'], ' Firefox/'))
        $a_opts['type'] = 'SOCKS5';
}

// Normally responds. {{{1

$s__ = "_='{$a_opts['type']} {$a_opts['host']}:{$a_opts['port']}';";
header('Content-Type: application/x-ns-proxy-autoconfig');
header('Content-Length: ' . (strlen($s__) + filesize($f_pac)));
header('Last-Modified: ' . gmdate('D, d M Y H:i:s T', $i_time));
if ('' != $s_etag)
    header('ETag: ' . $s_etag);
header("Content-Disposition: attachment; filename=\"szen-{$a_opts['type']}_{$a_opts['host']}:{$a_opts['port']}.pac\"");
print($s__);
readfile($f_pac);

# vim:se ft=php ff=unix fenc=utf-8 tw=120:
