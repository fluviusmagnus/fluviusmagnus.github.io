---
layout: post
title: "备份 VPS 至 Dropbox"
date: 2016-04-19 13:54:57 +0800
comments: true
categories: 计算机技术
tags:
- VPS
- linux
- 互联网
---
偶然想起自己的机器曾经丢失过数据，而那次仅仅是因为没有做一些基本的备份，可见备份数据确实是必须的。主机商已经提供了基本的快照的方法，虽然暂时不对这些备份收费，但每次都备份整台机器数据量未免过于庞大。此外，我还希望自己能够灵活查看备份里的内容，储存在某个私有的云空间里是再合适不过了。由于机器本身在国外，爬梯对我而言还算轻松，使用有着良好技术支持的 Dropbox 是再合适不过了。（喜感）<!--more-->

我的基本想法是，写一个 bash 脚本，用 cron 定时运行它。在脚本中使用 tar 打包需要备份的文件，然后用一个特别方便的第三方小程序 [Dropbox-Uploader](https://github.com/andreafabrizi/Dropbox-Uploader/) 把备份推上去即可。使用这个脚本需要在 Dropbox 创建一个 App 取得相应的 Key，具体可以看上述项目的说明和 Dropbox 的官方文档。如果你还没有 Dropbox 的账户，你可以点击 [这个链接](https://db.tt/ok8FuQ3e) 来注册，从这个渠道你和我都可以免费获得额外的 500MB 储存空间。

以下是我脚本的内容，仅供参考，具体的文件夹肯定是要你自己调整的。

```bash
bak_dir="/home/yourname/backup"
bak_time=`date +%F-%H%M%S`
tar -zcvf $bak_dir/home-$bak_time.tar.gz -X /home/yourname/backup_exclude_list /home
/home/yourname/dropbox_uploader.sh upload $bak_dir/* /
rm $bak_dir/*
```

有几个点需要注意。所谓 `bak_dir` 是一个专用的文件夹，每次用来备份后都会清空。`dropbox_uploader.sh` 是从前述项目中获取的，使用前需要单独运行一次，以做好设置。`backup_exclude_list` 是一个纯文本文件，其中每行为一个需要排除在压缩包外的文件的路径，之所以单独做一个列表是为了便于分开管理。在实际运行前最好先测试一下做出来的压缩包会不会太大，如果有大而不必要的东西最好事先排除，免得浪费空间和流量。

最后祝您，服务器平安，再见！
