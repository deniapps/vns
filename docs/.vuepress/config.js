import { searchPlugin } from "@vuepress/plugin-search";
import { sitemapPlugin } from "vuepress-plugin-sitemap2";
import { googleAnalyticsPlugin } from "@vuepress/plugin-google-analytics";
import { defineUserConfig } from "vuepress";
import { defaultTheme } from "vuepress";
import inferSiderbars from "./utils";

export default defineUserConfig({
  lang: "en-US",
  title: "VuePress Next Starter",
  description: "VuePress Next 懒人包 - VNS",
  base: "/vns/", // if deployed to the root, then use "/"
  head: [
    [
      "link",
      {
        rel: "icon",
        href: "/favicon.ico",
      },
    ],
  ],
  theme: defaultTheme({
    // default theme config
    logo: "/logo.png",
    sidebar: inferSiderbars(),
    navbar: [
      {
        text: "Home",
        link: "/",
      },
      {
        text: "How-Tos",
        link: "/how-tos/",
      },
      {
        text: "Demo",
        link: "/demo/",
      },
      {
        text: "Sites",
        link: "/powered-by-vns/",
      },
    ],
  }),
  configureWebpack: {
    resolve: {
      alias: {
        "@public": "./public",
      },
    },
  },
  plugins: [
    sitemapPlugin({
      // your options
      hostname: "vns.com",
    }),
    googleAnalyticsPlugin({
      // options
      id: "G-8R8LLBHPWX",
    }),
    searchPlugin({
      locales: {
        "/": {
          placeholder: "Search",
        },
        "/zh/": {
          placeholder: "搜索",
        },
      },
    }),
  ],
});
