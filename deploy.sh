#!/bin/sh

php genIndex.php
# 确保脚本抛出遇到的错误
set -e

# 生成静态文件
npm run build

# 进入生成的文件夹
cd docs/.vuepress/dist

# 上传的服务器
scp -r * adam@lamp.dnx:/var/www/61dh/.
