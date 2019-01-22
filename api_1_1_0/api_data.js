define({ "api": [
  {
    "type": "post",
    "url": "/a_monthly_task_assessment/get_car_pic/",
    "title": "4获取车辆图片",
    "version": "0.1.0",
    "name": "get_car_pic",
    "group": "a_monthly_task_assessment",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>应检/隐患列表id</p>"
          }
        ]
      }
    },
    "description": "<p>获取车辆图片</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_monthly_task_assessment.php",
    "groupTitle": "a_monthly_task_assessment",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_monthly_task_assessment/get_car_pic/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_monthly_task_assessment/submit_five_types/",
    "title": "3五类车检验任务",
    "version": "0.1.0",
    "name": "submit_five_types",
    "group": "a_monthly_task_assessment",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hphm",
            "description": "<p>号牌号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hpzl",
            "description": "<p>号牌种类</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "ywlx",
            "description": "<p>业务类型</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "sfch",
            "description": "<p>是否查处,0代表否,1代表是</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "wfcyy",
            "description": "<p>未查处原因</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "dsr",
            "description": "<p>当事人</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sfzmhm",
            "description": "<p>身份证名号码</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "czsj",
            "description": "<p>处置时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czjg",
            "description": "<p>处置结果</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "imagenum",
            "description": "<p>图片数量</p>"
          },
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "image_",
            "description": "<p>图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "jybh",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czr",
            "description": "<p>处置民警</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmdm",
            "description": "<p>部门代码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmmc",
            "description": "<p>部门名称</p>"
          }
        ]
      }
    },
    "description": "<p>获取任务信息</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_monthly_task_assessment.php",
    "groupTitle": "a_monthly_task_assessment",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_monthly_task_assessment/submit_five_types/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_monthly_task_assessment/task_insert/",
    "title": "2隐患,应检任务信息",
    "version": "0.1.0",
    "name": "task_insert",
    "group": "a_monthly_task_assessment",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>id值</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hphm",
            "description": "<p>号牌号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hpzl",
            "description": "<p>号牌种类</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "ywlx",
            "description": "<p>业务类型,1代表隐患,2代表应检,3代表五类</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "sfch",
            "description": "<p>是否查处,0代表否,1代表是</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "wfcyy",
            "description": "<p>未查处原因</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "dsr",
            "description": "<p>当事人</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sfzmhm",
            "description": "<p>身份证名号码</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "czsj",
            "description": "<p>处置时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czjg",
            "description": "<p>处置结果</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "imagenum",
            "description": "<p>图片数量</p>"
          },
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "image_",
            "description": "<p>图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "jybh",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czr",
            "description": "<p>处置民警</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmdm",
            "description": "<p>部门代码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmmc",
            "description": "<p>部门名称</p>"
          }
        ]
      }
    },
    "description": "<p>获取任务信息</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_monthly_task_assessment.php",
    "groupTitle": "a_monthly_task_assessment",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_monthly_task_assessment/task_insert/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_monthly_task_assessment/view_task_assessment/",
    "title": "1应检/隐患列表",
    "version": "0.1.0",
    "name": "view_task_assessment",
    "group": "a_monthly_task_assessment",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "accounts",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>类型,1代表隐患,2代表应检</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "num",
            "description": "<p>分页传递的参数,例1代表第一页，2代表第二页</p>"
          }
        ]
      }
    },
    "description": "<p>应检/隐患列表</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_monthly_task_assessment.php",
    "groupTitle": "a_monthly_task_assessment",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_monthly_task_assessment/view_task_assessment/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_pavement_control/select_task_class/",
    "title": "1任务类型列表",
    "version": "0.1.0",
    "name": "select_task_class",
    "group": "a_pavement_control",
    "description": "<p>获取任务类型列表</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_pavement_control.php",
    "groupTitle": "a_pavement_control",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_pavement_control/select_task_class/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_pavement_control/submit_pavement_control/",
    "title": "2路面防控任务反馈",
    "version": "0.1.0",
    "name": "submit_pavement_control",
    "group": "a_pavement_control",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hphm",
            "description": "<p>号牌号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hpzl",
            "description": "<p>号牌种类</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "rwlx",
            "description": "<p>任务类型(违法代码)</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "ywzl",
            "description": "<p>业务种类,1代表非现场,2代表简易程序,3代表强制措施</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bh",
            "description": "<p>任务类型对应的编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czsj",
            "description": "<p>处置时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czjg",
            "description": "<p>处置结果</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "imagenum",
            "description": "<p>图片数量</p>"
          },
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "image_",
            "description": "<p>图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "jybh",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czr",
            "description": "<p>处置民警</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmdm",
            "description": "<p>部门代码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmmc",
            "description": "<p>部门名称</p>"
          }
        ]
      }
    },
    "description": "<p>路面防控任务反馈</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_pavement_control.php",
    "groupTitle": "a_pavement_control",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_pavement_control/submit_pavement_control/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_update_password/get_password/",
    "title": "1获取警员密码",
    "version": "0.1.0",
    "name": "get_password",
    "group": "a_update_password",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "accounts",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>警员密码</p>"
          }
        ]
      }
    },
    "description": "<p>修改警员密码</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_update_password.php",
    "groupTitle": "a_update_password",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_update_password/get_password/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_update_password/modify_password/",
    "title": "2修改警员密码",
    "version": "0.1.0",
    "name": "modify_password",
    "group": "a_update_password",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "accounts",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "repassword",
            "description": "<p>修改密码</p>"
          }
        ]
      }
    },
    "description": "<p>修改警员密码</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_update_password.php",
    "groupTitle": "a_update_password",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_update_password/modify_password/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_user_login/verify_login/",
    "title": "警员登录",
    "version": "0.1.0",
    "name": "verify_login",
    "group": "a_user_login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "accounts",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>警员密码</p>"
          }
        ]
      }
    },
    "description": "<p>警员登录</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_user_login.php",
    "groupTitle": "a_user_login",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_user_login/verify_login/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_vehicle_access/car_inbound/",
    "title": "2车辆信息入库",
    "version": "0.1.0",
    "name": "car_inbound",
    "group": "a_vehicle_access",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hphm",
            "description": "<p>车牌号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hpzl",
            "description": "<p>号牌种类</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "dsr",
            "description": "<p>当事人</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sfzmhm",
            "description": "<p>身份证号码</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "czsj",
            "description": "<p>处置时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czjg",
            "description": "<p>处置结果</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tccmc",
            "description": "<p>停车场名称</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tccdz",
            "description": "<p>停车场地址</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "imagenum",
            "description": "<p>图片数量</p>"
          },
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "image_",
            "description": "<p>图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "jybh",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czr",
            "description": "<p>处置民警</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmdm",
            "description": "<p>部门代码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmmc",
            "description": "<p>部门名称</p>"
          }
        ]
      }
    },
    "description": "<p>获取车辆信息入库</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_vehicle_access.php",
    "groupTitle": "a_vehicle_access",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_vehicle_access/car_inbound/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_vehicle_access/car_outbound/",
    "title": "4车辆信息出库",
    "version": "0.1.0",
    "name": "car_outbound",
    "group": "a_vehicle_access",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "xh",
            "description": "<p>车辆入库的序号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hphm",
            "description": "<p>车牌号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hpzl",
            "description": "<p>号牌种类</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "dsr",
            "description": "<p>当事人</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sfzmhm",
            "description": "<p>身份证号码</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "czsj",
            "description": "<p>处置时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czjg",
            "description": "<p>处置结果</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tccmc",
            "description": "<p>停车场名称</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tccdz",
            "description": "<p>停车场地址</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "imagenum",
            "description": "<p>图片数量</p>"
          },
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "image_",
            "description": "<p>图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "jybh",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czr",
            "description": "<p>处置民警</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmdm",
            "description": "<p>部门代码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmmc",
            "description": "<p>部门名称</p>"
          }
        ]
      }
    },
    "description": "<p>车辆信息出库</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_vehicle_access.php",
    "groupTitle": "a_vehicle_access",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_vehicle_access/car_outbound/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_vehicle_access/car_outbound_along/",
    "title": "5信息直接出库",
    "version": "0.1.0",
    "name": "car_outbound_along",
    "group": "a_vehicle_access",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hphm",
            "description": "<p>车牌号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hpzl",
            "description": "<p>号牌种类</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "dsr",
            "description": "<p>当事人</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sfzmhm",
            "description": "<p>身份证号码</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "czsj",
            "description": "<p>处置时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "ckyy",
            "description": "<p>出库原因</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "sfqzck",
            "description": "<p>是否强制出库,0代表否,1代表是</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "jybh",
            "description": "<p>警员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "czr",
            "description": "<p>处置民警</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmdm",
            "description": "<p>部门代码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bmmc",
            "description": "<p>部门名称</p>"
          }
        ]
      }
    },
    "description": "<p>信息直接出库</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_vehicle_access.php",
    "groupTitle": "a_vehicle_access",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_vehicle_access/car_outbound_along/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_vehicle_access/car_outbound_check/",
    "title": "3出库信息查询",
    "version": "0.1.0",
    "name": "car_outbound_check",
    "group": "a_vehicle_access",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hphm",
            "description": "<p>车牌号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hpzl",
            "description": "<p>号牌种类</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sfzmhm",
            "description": "<p>身份证号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start_time",
            "description": "<p>起始时间</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束时间</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "num",
            "description": "<p>分页传递的参数,例1代表第一页，2代表第二页</p>"
          }
        ]
      }
    },
    "description": "<p>出库信息查询</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_vehicle_access.php",
    "groupTitle": "a_vehicle_access",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_vehicle_access/car_outbound_check/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_vehicle_access/get_vehicle_type/",
    "title": "1车辆号牌种类",
    "version": "0.1.0",
    "name": "get_vehicle_type",
    "group": "a_vehicle_access",
    "description": "<p>获取车辆号牌种类</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_vehicle_access.php",
    "groupTitle": "a_vehicle_access",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_vehicle_access/get_vehicle_type/"
      }
    ]
  },
  {
    "type": "post",
    "url": "/a_version/version/",
    "title": "版本信息",
    "version": "0.1.0",
    "name": "version",
    "group": "a_version",
    "description": "<p>版本信息</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>返回信息</p>"
          },
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "result",
            "description": "<p>正确的结果</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Response (example):",
          "content": "返回示例\n{\n  \"code\": \"100\"\n  \"message\": \"未知错误\"\n  \"result\": \"json\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "E:/xampp/htdocs/ak_system/application/controllers/API/api_1_1_0/A_version.php",
    "groupTitle": "a_version",
    "sampleRequest": [
      {
        "url": "http://192.168.1.87/ak_system/API/api_1_1_0/a_version/version/"
      }
    ]
  }
] });
