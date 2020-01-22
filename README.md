# 折淘客PHP接口库

该lib是基于折淘客所公开的接口，实现了大部分功能的封装。

安装
- composer 方式安装

```
composer require sige/zhetaoke
```

使用
- 商品查询
```php
use sige\zhetaoke\ZheTaoKe;
$goods = ZheTaoKe::getInstance()->goods()
    ->setSort(ZtkGoodsFetcher::SORT_TOTAL_SALE_NUM_ASC)
    ->setPage(1)
    ->setPageSize(10)
    ->fetchAll();
echo $goods[0]->taoId;
```
通过`taoId`获取商品信息：
```php
use sige\zhetaoke\ZheTaoKe;
$goods = ZheTaoKe::getInstance()->goods()
    ->fetchOneByTaoId('599424494783');
echo $goods->taoId;
```

- 订单查询
```php
use sige\zhetaoke\ZheTaoKe;
$orders = ZheTaoKe::getInstance()->order()
    ->setStartTime('2020-01-01 00:00:00')
    ->setEndTime('2020-01-01 00:10:00')
    ->fetchAll();
```

- 活动查询
```php
use sige\zhetaoke\ZheTaoKe;
# 查询所有活动信息
$activities = ZheTaoKe::getInstance()->activity()->fetchAll();
# 根据活动ID获取活动信息
$activity = ZheTaoKe::getInstance()->activity()->fetchOneById('1571715733668');
```
- 渠道查询
```php
use sige\zhetaoke\ZheTaoKe;
$response = ZheTaoKe::getInstance()->publisher()
    ->setRelationApp('common')
    ->setInfoType(1)
    ->fetchAll();
```
- 账号查询
```php
use sige\zhetaoke\ZheTaoKe;
$accounts = ZheTaoKe::getInstance()->account()->fetchAll();
```
- 商品推广链接生成
```php
use sige\zhetaoke\ZheTaoKe;
$goods = ZheTaoKe::getInstance()->goods()->fetchOneByTaoId('607037024445');
echo $goods->getCouponLink(); # 领取优惠券
echo $goods->getShareLink(); # 推广链接
echo $goods->getTaoKouLing(); # 淘口令
```
- 活动推广链接生成
```php
use sige\zhetaoke\ZheTaoKe;
$activity = ZheTaoKe::getInstance()->activity()
    ->fetchOneById('1571715733668');
$link = $activity->getShareLinkConverter()
    ->setAdzoneId(ZHETAOKE_TEST_ADZONE_ID)
    ->setSiteId(ZHETAOKE_TEST_SITE_ID)
    ->convert();
echo $link; # 活动推广链接
```
- 渠道邀请码生成
```php
use sige\zhetaoke\ZheTaoKe;
ZheTaoKe::getInstance()->publisherInviteCodeGenerator()
    ->setCodeType(1)
    ->setRelationApp('common')
    ->setRelationId('xxx')
    ->generate();
```
- 热门关键词查询
```php
use sige\zhetaoke\ZheTaoKe;
$keywords = ZheTaoKe::getInstance()->keywords()
    ->setPageSize(10)
    ->fetchAll();
```
- 联想词查询
```php
use sige\zhetaoke\ZheTaoKe;
$list = ZheTaoKe::getInstance()->suggest()
    ->setcontent('手机')
    ->fetchAll();
```
- 短连接生成
```php
use sige\zhetaoke\ZheTaoKe;
echo ZheTaoKe::getInstance()->shortUrl()->baidu('https://www.taobao.com');
echo ZheTaoKe::getInstance()->shortUrl()->sina('https://www.taobao.com');
echo ZheTaoKe::getInstance()->shortUrl()->sohu('https://www.taobao.com');
echo ZheTaoKe::getInstance()->shortUrl()->taobao('https://s.click.taobao.com/H4zazPx');
```
- 淘口令生成
```php
use sige\zhetaoke\ZheTaoKe;
$tkl = ZheTaoKe::getInstance()->tklCreator()
    ->setText("测试数据-测试数据")
    ->setUrl('https://uland.taobao.com/index.php')
    ->generate();
```
- 自定义接口调用
```php
use sige\zhetaoke\ZheTaoKe;
$response = ZheTaoKe::getInstance()->call(
    'open_tkl_create', # 接口名
    array() # 接口参数列表
);
```

TODO
- 渠道相关操作暂无测试数据~~~