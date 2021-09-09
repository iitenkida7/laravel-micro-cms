## 概要
* micro-cms の APIをLaravelから簡単に扱えるライブラリー（そもそも簡単だけど）
* 非公式
* 主目的は、Laravelのプラグイン開発の練習(?) と composer と仲良くなること。(今の所)

## Install

* Need Laravel8 or over.

* This version is not registered with packagist. Manually add to `composer.json`.

```composer.json
{
  "require": {
    "iitenkida7/laravel-micro-cms": "dev-main"
  },
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:iitenkida7/laravel-micro-cms.git"
    }
  ]
}
```

