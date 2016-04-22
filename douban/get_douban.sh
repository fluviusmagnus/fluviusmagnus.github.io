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
