---
layout: post
title: "导入豆瓣 RSS 至 Octopress"
date: 2016-02-14 14:14:30 +0800
comments: true
categories:
- 计算机技术
tags:
- linux
- 互联网
- 编程
---
大家也许已经熟悉了本站最近的运作风格，即发表的文章中有许多来自我在 [豆瓣](http://www.douban.com/people/elephantus/) 上的短评。之前在使用 WordPress 的时候，我使用了一个插件来导入 RSS 文件，虽然能用，但是并不稳定。<!-- more -->

如今我使用了 Octopress，这就意味着如果还要做这样一件事，就必须自己动手写一些东西了。非常幸运，这件事情可以还原为**从 RSS 迁移博客**，简单搜索便得到了 [官方指南](http://import.jekyllrb.com/docs/rss/)。由于避免重复劳动是美德，我便写了如下脚本放在 Octopress 目录下新建的 `douban` 文件夹中。

使用前除了注意脚本位置外，还应更改你所需的 URL 等信息，另外如果是第一次使用，可能还需要运行 `gem install jekyll-import` 安装相应依赖。

---
2016-02-22 更新

被友人刺激，我下决心改善一下本站 https 崩掉的情况。除了那个令人束手无策的评论框，想来大概也就是豆瓣的问题。本想做个查找替换，却无意间发现 RSS 文件本身如果用 https 调用，则里面的资源也都会相应改变。这下只要稍作修改，便一劳永逸。当然以前发布了的还是要手动改。

仔细看发现 http 版的 RSS 中豆瓣的图片资源有两类位置，其一类似于 `imgX.douban.com`，其二 `imgX.doubanio.com`，`X` 是一个数字。其中后者可以直接支持 https。而在 https 版的 RSS 中，所有资源都是后者形式。图片文件名虽然相同，但服务器的对应关系（主要是那个数字）我尚不明确，欢迎各位讨论。我觉得说不定豆瓣也要开始做全站 https 化了呢。

总之，下方代码也作出更新。

{% highlight bash %}
#!/bin/bash
# get_douban.sh
#
# This script gets 10 latest items in your collection in douban.com via its RSS file offered, and converts them to octopress posts.
# This script works in a subdirectory (you can create a new one) which has the same position as the directory 'source'.
# Before you run this, make sure that 'jekyll-import' is installed by gem.
# You must change the URL below to your own feed. You can also customize the category name.

# Change the URL below!
wget https://www.douban.com/feed/people/elephantus/interests -O douban.xml

ruby -rubygems -e 'require "jekyll-import";
    JekyllImport::Importers::RSS.run({
      "source" => "douban.xml"
    })'

for f in ./_posts/*
do
    # Maybe change this line. Check 'man sed' to know more about this.
    sed -i '3 acategories:\n-\ 豆瓣收藏\npublished:\ true\ncomments:\ true' $f
done

mv -nv ./_posts/* ../source/_posts/
rm ./_posts/*
{% endhighlight %}
