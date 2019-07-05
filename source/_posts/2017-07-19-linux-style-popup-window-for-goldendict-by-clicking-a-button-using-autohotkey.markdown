---
layout: post
title: "使用 AutoHotkey 在 Windows 上实现 Goldendict 划词翻译"
date: 2017-07-19 17:18:12 +0800
comments: true
categories: 计算机技术
---
看到这个标题，可能很难理解这种需求，因此我还是搬出 Goldendict 文档中关于屏幕取词在不同操作系统中的实现相关说明吧。

> If popup window is enabled it will be shown in next cases:
> - a) when hotkey was pressed;
> - b) (under Windows and MacOS only) when mouse cursor placed over target word and scanning is turned on (scanning turned on/off by [IMG] button on GoldenDict toolbar or via context menu of tray icon);
>   Note: in some applications scanning may don't work
> - c) (under Linux X11 only) when target word was selected and scanning is turned on;
> - d) when clipboard was changed and scanning is turned on. To use this mode under Windows and MacOS it needs to turn on it via config file.

由于我已经习惯了 Linux 那种先选中然后点一个按钮使窗口弹出的方式，在 Windows 上似乎无法如此使用，令我不悦，因此希望使用 AutoHotkey 来魔改一下逻辑。以下为脚本。

```
#NoEnv  ; Recommended for performance and compatibility with future AutoHotkey releases.
; #Warn  ; Enable warnings to assist with detecting common errors.


SendMode Input  ; Recommended for new scripts due to its superior speed and reliability.
SetWorkingDir %A_ScriptDir%  ; Ensures a consistent starting directory.

Gui, New, +AlwaysOnTop -Resize -MaximizeBox -MinimizeBox +MinSize -Caption, Dict
Gui, Add, Button, cBlue gSearch X20 Y0, Search
Gui, Margin, 0, 0
Gui, Show, NA AutoSize


OnMessage(0x0201, "WM_LBUTTONDOWN")

WM_LBUTTONDOWN()
{
  If (A_Gui)
    PostMessage, 0xA1, 2
}


Search:
Send, !{Tab}
Sleep, 300
Send, ^c
Sleep, 50
Send, ^c
return
```

如此会出现一个永远置顶的小窗口，可以拖动至别处，每次选中词后点击即可。

欢迎提出意见。
