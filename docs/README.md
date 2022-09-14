---
home: true
heroImage: false
heroText: VuePress Next Starter
tagline: VuePress Next 懒人包 - VNS

xfeatures:
  - title: How-Tos
    details: 虽然是懒人包，但是还是需要简单设置一下。有问题？进来看看！
    link: /how-tos/
  - title: 演示站
    details: 想看看效果如何？到GitHub Page瞧瞧！
    link: /demo/
  - title: Powered by VNS
    details: 有哪些网站在使用VuePress Next 懒人包?
    link: /powered-by-vns/


footer: MIT Licensed | Copyright © 2022-DENIAPPS
---

<div class="features">
  <div class="feature" v-for="feat in $page.frontmatter.xfeatures">
    <h2><a v-bind:href="feat.link">{{ feat.title }}</a></h2>
    <p>{{ feat.details }} <a v-bind:href="feat.link">GO &#10132;</a></p>
  </div>
</div>