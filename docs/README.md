---
home: true
heroImage: false
heroText: VuePress Next Starter
tagline: VuePress Next 懒人包 - VNS

xfeatures:
  - title: How-Tos
    details: 虽然是懒人包，但是还是需要简单设置一下。有问题？进来看看！
    link: /how-tos/
  - title: 站长日记
    details: 到61DH瞧瞧站长写的东西！
    link: "https://61dh.com/diary/"
  - title: Powered by VNS
    details: 有哪些网站在使用VuePress Next 懒人包?
    link: /powered-by-vns/


footer: MIT Licensed | Copyright © 2022-DENIAPPS
---

<div class="features">
  <div class="feature" v-for="feat in $page.frontmatter.xfeatures">
    <h2><a v-bind:href="$withBase(feat.link)">{{ feat.title }}</a></h2>
    <p>{{ feat.details }} <a v-bind:href="$withBase(feat.link)">GO &#10132;</a></p>
  </div>
</div>