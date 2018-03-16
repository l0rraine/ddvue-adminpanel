# DDVue\AdminPanel
后台管理模块，需要 laravel 5.x，vue，element-ui。

## 安装

```
composer require ddvue/adminpanel
php artisan vendor:publish
select the Provider and tag with ddvue
```

## 使用

1. 首先`php artisan migrate`
2. 在config/ddvue/base.php中可以配置后台路由前缀
3. 可以在网站里直接调用`route('Ddvue.AdminPanel.home')`

### vue说明
#### 公共事件
`Vue.prototype.$eventHub = Vue.prototype.$eventHub || new Vue();`
使用时注意，在调用方法里要先off掉事件，结束时再on，否则可能出现重复调用的情况。

