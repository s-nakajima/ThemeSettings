ThemeSettings Plugin
====================

[![Build Status](https://travis-ci.org/NetCommons3/ThemeSettings.svg?branch=master)](https://travis-ci.org/NetCommons3/ThemeSettings)
[![Coverage Status](https://coveralls.io/repos/NetCommons3/ThemeSettings/badge.png)](https://coveralls.io/r/NetCommons3/ThemeSettings)

| dependencies | status |
| ------------ | ------ |
| Gemfile | [![Dependency Status](https://www.versioneye.com/user/projects/52f1cc16ec13757904000127/badge.png)](https://www.versioneye.com/user/projects/52f1cc16ec13757904000127) |
| composer.json | [![Dependency Status](https://www.versioneye.com/user/projects/52f1cc19ec13756b480000c4/badge.png)](https://www.versioneye.com/user/projects/52f1cc19ec13756b480000c4) |

## テーマ構造

<pre>
 |- ThemeName/ (1) テーマデータの入っているフォルダ
 |		|- webroot/ (2)公開領域
 |		|	|-css/  (3) css格納フォルダ
 |		|	|	|- bootstrap.min.css (4)
 |		|	|	|- style.css         (5)
 |		|	|-img/ (6) 画像格納フォルダ
 |		|	|-fonts/ (7) fontデータ格納フォルダ
 |		|	|-screenshot.png (8) スクリーンショット画像
 |-theme.json (9)設定ファイル
</pre>


