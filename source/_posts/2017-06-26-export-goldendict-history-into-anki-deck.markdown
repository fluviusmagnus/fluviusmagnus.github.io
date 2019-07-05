---
layout: post
title: "导出 Goldendict 记录至 Anki Deck"
date: 2017-06-26 21:15:08 +0800
comments: true
categories: 计算机技术
---
自从开始使用 Anki，往里面添加词汇数据就变成了一件辛苦的工作。英语日语学习者可能已经有了比较好的自动化工具可以使用，而其他一些语言则相对匮乏。另一方面，Goldendict 是比较好用的桌面词典程序，是我的日常主力，内置了非常朴实的历史查询记录的功能，最新的版本还有手动收藏生词的功能，不过大同小异，选择普通的文本导出即可。文件格式很简单，一行一个词，处理难度很小。因此，我考虑从这里入手。<!--more-->

我之前也参考了 [这篇文章](https://www.reddit.com/r/Anki/comments/34imaw/export_from_goldendict_to_anki_deck_working_method/) 提供的思路，但是 XDXF 格式的词典所用的转换工具似乎已经无人维护，编译失败，我不得不考虑自己重新写一个工具。

我先利用支持多种格式转换的 [PyGlossary](https://github.com/ilius/pyglossary) 将词典转换为 SQL，再用其他工具转换为 SQLite3 格式。（不直接转是因为似乎有 BUG，不能成功。）然后利用以下 Python3 脚本得到可以导入 Anki 的 CSV 文件。代码中文件名仅作为示例，你应该根据自己的情况替换。

```python
#!/usr/bin/env python3
import sqlite3
import csv

conn = sqlite3.connect('Langenscheidt e-Großwörterbuch Deutsch als Fremdsprache.sqlite3')
c = conn.cursor()

with open('favlist.txt') as inf:
    words = inf.read().split('\n')
words[0] = words[0].replace('\ufeff', '')
 
print('If error occurs, check if the broken entry can be found in dictionary.')
with open('favlist.csv', 'w') as outf:
    listwriter = csv.writer(outf)
    for wd in words:
        print('Adding: ' + wd)
        c.execute('SELECT m FROM word WHERE w=?', (wd,))
        result = c.fetchone()
        listwriter.writerow([wd, result[0]])
        
conn.close()
print('Done')
```

编写过程中被那个 BOM 阻碍，很久查不出错误，非常感谢微软。
