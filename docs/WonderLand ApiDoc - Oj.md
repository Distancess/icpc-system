# WonderLand ApiDoc - Oj

标签（空格分隔）： WonderLand

---

## **日志**

| 日期           | 备注                                       |
| ------------ | ---------------------------------------- |
| **17/12/12** | 添加接口 · **【手动刷新个人近期做题记录】**                |
| **17/12/3**  | 添加接口 · **【获取题量排行】**                      |
| **17/11/29** | 修改接口 · **【修改get_oj_account 返回值:增加Account、删除OJpassword】** |
| **17/11/07** | 添加接口 · **【添加oj关联账号 add_oj_account】**     |
| **17/11/07** | 添加接口 · **【获取oj过题数信息 get_oj_acproblems】** |
| **17/11/08** | 添加接口 · **【查询用户所有oj关联账号信息 get_oj_account】** |
| **17/11/08** | 添加接口 · **【删除用户oj关联账号信息 del_oj_account】** |
| **17/12/01** | 添加接口 · **【查询用户oj近期(两周)过题详细信息 get_oj_acinfo】** |

---

## **属性**

- **【oj_account 表】**

| 属性名            | 中文    | 最小长度 | 最大长度 | 类型       | 特殊要求              |
| -------------- | ----- | ---- | ---- | -------- | ----------------- |
| **Uusername**  | 用户名   | 6    | 16   | char(20) | 字母/数字/下划线/破折号     |
| **OJname**     | oj名称  | -    | -    | char(20) | 为"hdu"或"foj"或"cf" |
| **OJpassword** | oj密码  | -    | -    | char(20) | -                 |
| **OJusername** | oj用户名 | -    | -    | char(20) | -                 |

---

## **接口 · 添加oj关联账号**

- **请求方法：POST**
- **接口网址：http://icpc-system.and-who.cn/Oj/add_oj_account**

- **表单要求**

| 属性名            | 必要性  | 最小长度 | 最大长度 | 特殊要求                            |
| -------------- | ---- | ---- | ---- | ------------------------------- |
| **Uusername**  | O    | 6    | 16   | 字母/数字/下划线/破折号                   |
| **OJname**     | O    | -    | -    | 为"hdu"或"foj"或"cf" 分别表示添加对应oj的账号 |
| **OJpassword** | O    | -    | -    | -                               |
| **OJusername** | O    | -    | -    | -                               |


- **成功返回例子**

```
{
	"type": 1,
	"message": "添加成功",
	"data": []
}
```

---

## **接口 · 获取oj过题数信息**

- **请求方法：GET**
- **接口网址：http://icpc-system.and-who.cn/Oj/get_oj_acproblems?Uusername=&OJname=**

| **返回的信息包含** | 备注   |
| ----------- | ---- |
| **data**    | 过题数量 |


- **成功返回例子**

```
{
	"type": 1,
	"message": "查询成功",
	"data": "22" 
}
```

---

## **接口 · 查询用户所有oj关联账号信息**

- **请求方法：POST**
- **接口网址：http://icpc-system.and-who.cn/Oj/get_oj_account**

- **表单要求**

| 属性名           | 必要性  | 最小长度 | 最大长度 | 特殊要求          |
| ------------- | ---- | ---- | ---- | ------------- |
| **Uusername** | O    | 6    | 16   | 字母/数字/下划线/破折号 |


- **成功返回例子**

```
{
	"type": 1,
	"message": "查询成功",
	"data": [
		{
			"OJname": "cf",
			"OJusername": "xxxxxxx",
			"Account": "xx"
		},
		{
			"OJname": "foj",
			"OJusername": "xxxxxxx",
			"Account": "xx"
		},
		{
			"OJname": "hdu",
			"OJusername": "xxxxxxx",
			"Account": "xx"
		}
	]
}
```

---

## **接口 · 删除oj关联账号信息**

- **请求方法：POST**
- **接口网址：http://icpc-system.and-who.cn/Oj/del_oj_account**

- **表单要求**

| 属性名           | 必要性  | 最小长度 | 最大长度 | 特殊要求                              |
| ------------- | ---- | ---- | ---- | --------------------------------- |
| **Uusername** | O    | 6    | 16   | 字母/数字/下划线/破折号                     |
| **OJname**    | O    | -    | -    | 为"hdu"或"foj"或"cf" 分别表示删除对应oj的关联账号 |


- **成功返回例子**

```
{
	"type": 1,
	"message": "删除成功",
	"data": []
}
```

---

## **接口 · 查询用户oj近期(两周)过题详细信息**

- **请求方法：GET**
- **接口网址：http://icpc-system.and-who.cn/Oj/get_oj_acinfo?Uusername=**

| **返回的信息包含**    | 备注   |
| -------------- | ---- |
| **ac_account** | 题数   |
| **OJname**     | OJ名称 |
| **time**       | 过题时间 |
| **name**       | 过题名称 |
| **url**        | 过题链接 |


- **成功返回例子**

```
{
	"type": 1,
	"message": "查询成功",
	"data": {
		"ac_count": 2,
		"ac_info": [
			{
				"OJname": "hdu",
				"time": "2017-12-07 19:02:06",
				"name": "hdu3966",
				"url": "http:\/\/acm.hdu.edu.cn\/showproblem.php?pid=3966"
			},
			{
				"OJname": "cf",
				"time": "2017-12-02 19:34:14",
				"name": "895B - XK Segments",
				"url": "http:\/\/codeforces.com\/problemset\/problem\/895\/B"
			}
		]
	}
}
```

---

## **接口 · 获取题量排行**

- **请求方法：GET**
- **接口网址：http://icpc-system.and-who.cn/Oj/get_list**

  | **返回的信息包含** | 备注 |
  | -----------	| -------- |
  | **username**| 用户名|
  | **realname**| 真实姓名 |
  | **total**   | 总过题数 |
  | **cf**      | cf过题数量 |
  | **hdu**     | cf过题数量 |
  | **foj**     | cf过题数量 |


- **成功返回例子**
```
{
	"type": 1,
	"message": "获取成功",
	"data": [
		{
			"username": "aaaau1",
			"realname": "a 真实姓名真实姓名",
			"total": "372",
			"cf": "372",
			"hdu": "0",
			"foj": "0"
		},
		{
			"username": "aaaau2",
			"realname": "a 真实姓名真实姓名",
			"total": "146",
			"cf": "0",
			"hdu": "146",
			"foj": "0"
		}
	]
}
```

---


## **接口 · 刷新个人题量缓存**

- **请求方法：POST**
- **接口网址：http://icpc-system.and-who.cn/Oj/refresh**


- **表单要求**

| 属性名 | 必要性 | 最小长度 | 最大长度 | 特殊要求 |
| ------------- | ---- | ---- | ---- | ------------- |
| **Uusername** | O    | 6    | 16   | 字母/数字/下划线/破折号 |


- **成功返回例子**
```
{
	"type": 1,
	"message": "刷新成功",
	"data": {
		"Last_visit": "17-12-11 01:01:24",
		"Uusername": "Kirito",
		"cf": {
			"OJname": "cf",
			"ACproblem": "268"
		},
		"foj": {
			"OJname": "foj",
			"ACproblem": "2"
		}
	}
}
```

---
## **接口 · 手动刷新个人近期做题记录**

- **请求方法：POST**
- **接口网址：http://icpc-system.and-who.cn/Oj/refresh_recent_ac**


- **表单要求**

| 属性名           | 必要性  | 最小长度 | 最大长度 | 特殊要求          |
| ------------- | ---- | ---- | ---- | ------------- |
| **Uusername** | O    | 6    | 16   | 字母/数字/下划线/破折号 |


- **成功返回例子**
```
{
	"type": 1,
	"message": "刷新成功",
	"data": ""
}
```

---
