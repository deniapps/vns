---
sidebar: auto
---

# 自动设置侧边栏

根据指南，`sidebar: auto`只对当前页面有效：

> 如果你设置为 'auto'，侧边栏会根据页面标题自动生成。

VuePress没有提供文件夹内文件索性的边侧栏功能。但是我们可以利用sidebar的特殊值来实现。

## SidebarConfigArray

侧边栏数组 - 所有页面会使用相同的侧边栏

## SidebarConfigObject

侧边栏对象 - 不同子路径下的页面会使用不同的侧边栏

## 自动生成目录下的边侧栏
VNS 在全局配置文件(`docs/.vuepress/config.js`)里把sidebar设置为SidebarConfigObject，即在特定目录下使用相同的侧边栏，而这个侧边栏包含文件夹下的所有文件的索引，即“子数组”， 它是通过用utils函数`dcos/.vuepress/utils.js`自动生成。

[试试看](inner-demo/demo1.html)




