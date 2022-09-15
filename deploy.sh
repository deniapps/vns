#!/bin/sh

##########################################################
####建议保存本文件为local_deploy.sh, 然后度身定制，再运行。#####
##########文件以“local_”开头的自动加入.gitignore!!###########
##########################################################

# 自动生成文件夹下的索引页
# php genIndex.php

# 确保脚本抛出遇到的错误
set -e

# 生成静态文件
npm run build

# 进入生成的文件夹
cd docs/.vuepress/dist

#创建.nojekyll 防止Github Pages build错误
touch .nojekyll

git init
#如果你没有设置global git user, 或者你不想用默认的user，那么在这里设置
# git config user.name "YOURNAME."
# git config user.email "YOUREMAIL"

git add -A
git commit -m 'deploy'

# AGAIN! 把本文件另存为local_deploy.sh，然后修改下面的部署地址
# gh_access_token 必须再你的环境变量里。如果你用的是mac，可以加到~/.zschrc里
# 如何设置github access token: https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token
git push -f "https://${gh_access_token}@github.com/deniapps/vns.git" main:vns-demo

cd -
