﻿# WonderLand ApiDoc - Team

标签（空格分隔）： WonderLand

---

## **日志**

| 日期         | 备注  
| ------------ | ------
| **17/07/--** | 添加接口 · **【注册队伍 · register】**
| **17/07/--** | 添加接口 · **【获取队伍信息 · get】**
| **17/07/--** | 添加接口 · **【获取所有队伍列表 · get_all】**
| **17/07/09** | 添加接口 · **【获取用户队伍列表 · get_list】**
| **17/07/09** | **【WonderLand Beta 1.0 Compeleted】**



---

## **属性**

- **`【team 表】`**

| 属性名          | 中文   | 最小长度 | 最大长度 | 类型      | 特殊要求
| --------------- | ------ | -------- | -------- | --------- | --------
| **Tteamname**   | 队伍名 | 1        | 16       | char(20)  | **字母/数字/下划线/破折号** 
| **Uusername_1** | 成员1  | -        | -        | char(20)  | -                       
| **Uusername_2** | 成员2  | -        | -        | char(20)  | - 
| **Uusername_3** | 成员3  | -        | -        | char(20)  | -          
| **Tplan_1**     | 成员1近期计划 | - | 200      | char(200) | -           
| **Tplan_2**     | 成员2近期计划 | - | 200      | char(200) | -            
| **Tplan_3**     | 成员3近期计划 | - | 200      | char(200) | -          


---

## **接口 · 注册队伍**

- **请求方法：POST**
- **接口网址：http://icpc-system.and-who.cn/Team/register**

| 属性名          | 必要性 | 最小长度 | 最大长度 | 特殊要求
| --------------- | ------ | -------- | -------- | --------
| **Tusername**   | O      | 1        | 16       | **字母/数字/下划线/破折号**
| **Utoken**      | O      | -        | -        | **持有token的用户即作为成员1**
| **Uusername_2** | O      | -        | -        | -    
| **Uusername_3** | O      | -        | -        | -    


- **成功返回**

```
{
	"type": 1,
	"message": "注册成功",
	"data": []
}
```

---

## **接口 · 获取队伍信息**

- **请求方法：GET**
- **接口网址：http://icpc-system.and-who.cn/Team/get?:Tteamname**

| **返回的队伍信息包含** | 备注
| ---------------------- | ----
| **Tteamname**          | 队伍名
| **Uusername_1**        | 成员1
| **Uusername_2**        | 成员2
| **Uusername_3**        | 成员3
| **Tplan_1**            | 成员1近期计划
| **Tplan_2**            | 成员2近期计划
| **Tplan_3**            | 成员3近期计划


- **成功返回**
```
{
	"type": 1,
	"message": "获取成功",
	"data": {
		"Tteamname": "a teamname",
		"Uusername_1": "aaaau2",
		"Uusername_2": "aaaau2",
		"Uusername_3": "aaaau2",
		"Tplan_1": "",
		"Tplan_2": "",
		"Tplan_3": ""
	}
}
```

---

## **接口 · 获取所有队伍列表**

- **请求方法：GET**
- **接口网址：http://icpc-system.and-who.cn/Team/get_all?:page_size&:page**

| **`GET` 字段可选项** | 备注
| --------------- | --------
| **page_size**   | 设置分页大小，和 **page** 成对存在
| **page**        | 设置查询页，和 **page_size** 成对存在


| **返回的队伍信息包含** | 备注
| ---------------------- | ----
| **Tteamname**          | 队伍名
| **Uusername_1**        | 成员1
| **Uusername_2**        | 成员2
| **Uusername_3**        | 成员3
| **Tplan_1**            | 成员1近期计划
| **Tplan_2**            | 成员2近期计划
| **Tplan_3**            | 成员3近期计划



- **接口网址：http://icpc-system.and-who.cn/Team/get_all?page_size=4&page=2**
```
{
	"type": 1,
	"message": "获取成功",
	"data": {
		"page_size": "4",
		"page": "2",
		"page_max": 2,
		"data": [
			{
				"Tteamname": "au2",
				"Uusername_1": "aaaau2",
				"Uusername_2": "aaaau2",
				"Uusername_3": "aaaau3",
				"Tplan_1": "",
				"Tplan_2": "",
				"Tplan_3": ""
			},
			{
				"Tteamname": "au",
				"Uusername_1": "aaaau41",
				"Uusername_2": "aaaau2",
				"Uusername_3": "aaaau3",
				"Tplan_1": "",
				"Tplan_2": "",
				"Tplan_3": ""
			}
		]
	}
}
```

---

## **接口 · 获取用户队伍列表**

- **请求方法：GET**
- **接口网址：http://icpc-system.and-who.cn/Team/get_list?:Uusername:page_size&:page**

| **`GET` 字段可选项** | 备注
| --------------- | --------
| **page_size**   | 设置分页大小，和 **page** 成对存在
| **page**        | 设置查询页，和 **page_size** 成对存在


| **返回的队伍信息包含** | 备注
| ---------------------- | ----
| **Tteamname**          | 队伍名
| **Uusername_1**        | 成员1
| **Uusername_2**        | 成员2
| **Uusername_3**        | 成员3


- **请求示例：http://icpc-system.and-who.cn/Team/get_list?Uusername=aaaau2&page_size=4&page=2**
```
{
	"type": 1,
	"message": "获取成功",
	"data": {
		"page_size": "4",
		"page": "2",
		"page_max": 2,
		"data": [
			{
				"Tteamname": "ateamname",
				"Uusername_1": "aaaau1",
				"Uusername_2": "aaaau2",
				"Uusername_3": "aaaau2"
			},
			{
				"Tteamname": "ateamname1",
				"Uusername_1": "aaaau1",
				"Uusername_2": "aaaau2",
				"Uusername_3": "aaaau3"
			}
		]
	}
}
```
