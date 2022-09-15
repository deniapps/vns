---
sidebar: auto
description: How to use VNS (Vuepress Next Starter)
---

# How to use VuePress Next Starter

## 从哪里开始？
超级简单！几条命令而已：

```shell
git clone git@github.com:deniapps/vns.git
cd vns
// use yarn
yarn
yarn dev
// OR use npm
npm install
npm run dev
```
## 如何修改网站信息
请到`docs/.vuepress/config.js`文件里，逐个修改，这里就不啰嗦了。如果有问题，请到issues里提问。
## 如何修改主页横幅
- 先找一张中意的图片，推荐[unsplash](https://unsplash.com/)高质量和免费的图片分享站
- 然后修改css: `docs/.vuepress/style`

**定义图片地址**

``` scss
$backUrl: "https://images.unsplash.com/photo-1547936785-c57315d64694?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1789&q=80";
```
如果你想用本地图片，可以保存到`docs/.vuepress/public/images`, 然后用相对路径: `/images/YOUR-BACKGROUND.png`;

**修改css**
``` css {3,4,10}
.theme-container {
  .hero {
    background-color: darkgreen;
    background-image: url($backUrl);
    width: 100%;
    margin: var(--navbar-height) 0 0 0;
    height: 45vh;
    background-repeat: no-repeat;
    background-size: cover;
    color: #fff !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
```
注意几点：
- 字体颜色和背景图片对比度要高，比例，选了深色背景，那么字体可以用白色，但是浅色背景，那么字体应该用深色。
- backgrou-color的颜色应该和图片颜色相似，这样当图片在加载的时候活着加载失败时，不会伤害用户体验。
  
## 如何修改logo/favicon
这两个文件在`docs/.vuepress/public`文件夹里。
**推荐** [Adobe Express](https://express.adobe.com/sp/)来设计自己的Logo,然后用[PNG to ICO Converter](https://www.freeconvert.com/png-to-ico)生成favion.ico。

## 如何添加页面
- 在`docs`下创建一个目录，ex: new-page
- 在目录下创建一个文件,命名为"README.md"
- 然后，你就可以通过这个URL: `BASEURL/new-page`访问你刚刚创建的页面了。
- 更多知识，请查看[指南](https://v2.vuepress.vuejs.org/zh/guide/page.html)

## 如何自动生成目录下的边侧栏

- 首先定义你想要自动生成边侧栏的文件夹。打开`docs/.vuepress/sidebarMap.js`

```
const sidebarMap = [{ title: "Inner Demo", dirname: "demo/inner-demo" }];
export default sidebarMap;
```

如上设置，`/demo/inner-demo`路径下的文件就相同的侧边栏，而这个侧边栏的子菜单是根据文件夹的文件动态生成的。(注意：在本地环境下，你需要重启vuepress才可以看到新加入的文件)

[试试看看](/demo/inner-demo/)


## 如何部署

请参考`deploy.sh`