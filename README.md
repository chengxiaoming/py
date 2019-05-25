# py
仿微信朋友圈网站源码

前端：html+css+js+jQuery
后端：php5.4+mysql 建议php5.5版本以下

搭建方法：
修改conn/conn.php的数据库配置文件
修改pic.php,pic2.php,pic3.php的七牛对象储存Key
导入pengyou.sql数据库

用户端功能
1.自适应手机，电脑。
2.具有发布视频和图片说说功能
3.能够进行登录
4.能修改头像。

网站采用前后端分离方式，从原版精简而成。
上传图片和视频均上传到七牛云储存。
