<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

Breadcrumbs::for('admin.spider.tbshow', function($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('淘宝内页抓取', url('admin/spider/tb/show'));
});

Breadcrumbs::for('admin.spider.tbsearch', function($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('淘宝搜索页抓取', url('admin/spider/tb/search'));
});
Breadcrumbs::for('admin.spider.tbsearch.item', function($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('淘宝搜索页抓取结果', url('admin/spider/tb/search'));
});
Breadcrumbs::for('admin.spider.tbshow.info', function($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('淘宝内页抓取结果', url('admin/spider/tb/show'));
});

Breadcrumbs::for('admin.jiangshanshi', function($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('拼购网', url('admin/content'));
});


Breadcrumbs::for('admin.category.index', function($trail) {
    $trail->parent('admin.jiangshanshi');
    $trail->push('栏目管理', url('admin/content/category'));
});

Breadcrumbs::for('admin.keyword.index', function($trail) {
    $trail->parent('admin.jiangshanshi');
    $trail->push('关键字管理', url('admin/content/keyword'));
});
Breadcrumbs::for('admin.keyword.create', function($trail) {
    $trail->parent('admin.keyword.index');
    $trail->push('关键字批量添加', url('admin/content/keyword/create'));
});
//Breadcrumbs::for('admin.keyword.search', function($trail) {
//    $trail->parent('admin.keyword.index');
//    $trail->push('关键字查询', url('admin/content/keyword/search'));
//});


Breadcrumbs::for('admin.nccne', function($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('你瞅啥', route('admin.nccne'));
});

Breadcrumbs::for('admin.nccne.block.index', function($trail) {
    $trail->parent('admin.nccne');
    $trail->push('文章管理', route('admin.nccne.block.index'));
});

Breadcrumbs::for('admin.nccne.block.edit', function($trail, $id) {
    $trail->parent('admin.nccne.block.index');
    $trail->push('修改文章', route('admin.nccne.block.edit', $id));
});

Breadcrumbs::for('admin.chinawbk', function($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('移动图书网', route('admin.chinawbk'));
});

Breadcrumbs::for('admin.chinawbk.block.index', function($trail) {
    $trail->parent('admin.chinawbk');
    $trail->push('文章管理', route('admin.chinawbk.block.index'));
});

Breadcrumbs::for('admin.chinawbk.block.edit', function($trail, $id) {
    $trail->parent('admin.chinawbk.block.index');
    $trail->push('修改文章', route('admin.chinawbk.block.edit', $id));
});




