/* 测试数据用 */

var carlistdata = { "listdata": [
{ "id": "1", "name": "150625王明宏雅迪电动车被盗", "begintime": "2015-06-25 10:23:00", "bdtime": "2015-06-25 11:39:00", "bdaddress": "滨江路建行宿舍外围", "gis": "116.004303,29.736834", "bdimg": "", "bdimg1": "", "carname": "雅迪YD-20F", "bdcolor": "红色", "cpnum": "G3386", "cjnum": "C2280", "fdjnum": "F2210", "bdimg2": "", "other": "无反光镜", "czname": "王明宏", "sfzID": "325008199002215579", "czaddress": "滨江路建行宿舍", "phone": "13786995526", "bdimg3": "", "vedio": "", "xyrtz": "偏瘦,个子矮,黑皮衣,秃头", "state": "待侦", "admin": "李姚红" },
{ "id": "2", "name": "150821李安顺新日电动车被盗", "begintime": "2015-08-21 08:15:00", "bdtime": "2015-08-21 10:22:00", "bdaddress": "滨江路塔岭北路", "gis": "116.007579,29.73796", "bdimg": "ddc/tc01.jpg", "bdimg1": "ddc/hj01.jpg", "carname": "新日GH-50C", "bdcolor": "红色", "cpnum": "G2280", "cjnum": "C6699", "fdjnum": "F8854", "bdimg2": "ddc/001.jpg", "other": "有后备箱,后备箱红白黑三色", "czname": "李安顺", "sfzID": "325008198012116025", "czaddress": "滨江路塔岭北路", "phone": "13137756889", "bdimg3": "ddc/jc01.jpg", "vedio": "ddc/shipin01.flv", "xyrtz": "平头,圆脸", "state": "侦破", "admin": "李澄" },
{ "id": "3", "name": "150715赵新国绿源电动车被盗", "begintime": "2015-07-15 11:30:00", "bdtime": "2015-07-15 15:00:00", "bdaddress": "滨江东路", "gis": "116.08047,29.754694", "bdimg": "ddc/tc02.jpg", "bdimg1": "ddc/hj02.jpg", "carname": "绿源MF-30V", "bdcolor": "黄色", "cpnum": "G2588", "cjnum": "C5598", "fdjnum": "F2256", "bdimg2": "ddc/002.jpg", "other": "缺一边后视镜", "czname": "赵新国", "sfzID": "325008198506186025", "czaddress": "滨江东路", "phone": "13566987576", "bdimg3": "ddc/jc02.jpg", "vedio": "ddc/shipin02.flv", "xyrtz": "头发较长,有胡子", "state": "待侦", "admin": "姚红兵" },
{ "id": "4", "name": "150721孙小杰爱玛电动车被盗", "begintime": "2015-07-21 15:30:00", "bdtime": "2015-07-21 18:01:00", "bdaddress": "滨江大道", "gis": "116.087688,29.754647", "bdimg": "ddc/tc03.jpg", "bdimg1": "ddc/hj03.jpg", "carname": "爱玛MT-30U", "bdcolor": "粉色", "cpnum": "G3266", "cjnum": "C1155", "fdjnum": "F2555", "bdimg2": "ddc/003.jpg", "other": "前大灯镜有裂痕", "czname": "孙小杰", "sfzID": "325008198707256035", "czaddress": "滨江大道", "phone": "13855921560", "bdimg3": "ddc/jc03.jpg", "vedio": "ddc/shipin01.flv", "xyrtz": "嘴角有红斑,黑皮衣,秃头", "state": "待侦", "admin": "姚红兵" },

{ "id": "5", "name": "151009李菲菲爱玛电动车被盗", "begintime": "2015-10-09 12:40:00", "bdtime": "2015-10-09 16:22:00", "bdaddress": "甘棠北路", "gis": "116.003823,29.736231", "bdimg": "ddc/tc04.jpg", "bdimg1": "ddc/hj04.jpg", "carname": "爱玛MT-50U", "bdcolor": "橙色", "cpnum": "G2390", "cjnum": "C5886", "fdjnum": "F0023", "bdimg2": "ddc/004.jpg", "other": "灰色座垫", "czname": "李菲菲", "sfzID": "325008198904187065", "czaddress": "甘棠北路", "phone": "13566237749", "bdimg3": "ddc/jc04.jpg", "vedio": "ddc/shipin02.flv", "xyrtz": "黑色风衣,鸭嘴帽", "state": "侦破", "admin": "李姚红" },

{ "id": "6", "name": "151022孔卫翔绿源电动车被盗", "begintime": "2015-10-22 10:20:00", "bdtime": "2015-10-22 11:45:00", "bdaddress": "滨江路九江豪庭", "gis": "116.011349,29.740302", "bdimg": "ddc/tc01.jpg", "bdimg1": "ddc/hj01.jpg", "carname": "爱玛CK-30U", "bdcolor": "黑色", "cpnum": "G2335", "cjnum": "C7769", "fdjnum": "F3522", "bdimg2": "ddc/005.jpg", "other": "左后视镜有裂痕", "czname": "孔卫翔", "sfzID": "325008198308196552", "czaddress": "滨江路九江豪庭", "phone": "13479682258", "bdimg3": "ddc/jc01.jpg", "vedio": "ddc/shipin01.flv", "xyrtz": "身穿白色球鞋", "state": "待侦", "admin": "姚民初" },

{ "id": "7", "name": "150924吴洁新日电动车被盗", "begintime": "2015-09-24 08:34:00", "bdtime": "2015-09-24 12:15:00", "bdaddress": "长虹北路", "gis": "116.023674,29.73254", "bdimg": "ddc/tc02.jpg", "bdimg1": "ddc/hj02.jpg", "carname": "新日LC-50M", "bdcolor": "蓝色", "cpnum": "G6285", "cjnum": "C0124", "fdjnum": "F8956", "bdimg2": "ddc/006.jpg", "other": "刚买的车,较新", "czname": "吴洁", "sfzID": "325008199203222345", "czaddress": "长虹北路", "phone": "13633528978", "bdimg3": "ddc/jc02.jpg", "vedio": "ddc/shipin02.flv", "xyrtz": "鸭嘴帽,身高1.7米左右", "state": "侦破", "admin": "李姚红" },

{ "id": "8", "name": "150620周红生雅马电动车被盗", "begintime": "2015-06-20 08:25:00", "bdtime": "2015-09-24 11:15:00", "bdaddress": "龙开河路", "gis": "115.985586,29.717548", "bdimg": "ddc/tc03.jpg", "bdimg1": "ddc/hj03.jpg", "carname": "雅马KN-50Q", "bdcolor": "绿色", "cpnum": "G3365", "cjnum": "C4565", "fdjnum": "F7824", "bdimg2": "ddc/007.jpg", "other": "无后视镜", "czname": "周红生", "sfzID": "325008199112168795", "czaddress": "龙开河路", "phone": "15569775362", "bdimg3": "ddc/jc03.jpg", "vedio": "ddc/shipin01.flv", "xyrtz": "穿黑色皮鞋", "state": "侦破", "admin": "李姚红" },

{ "id": "9", "name": "150709张亮雅迪电动车被盗", "begintime": "2015-07-09 07:33:00", "bdtime": "2015-07-09 13:28:00", "bdaddress": "长虹北路", "gis": "116.023584,29.736178", "bdimg": "ddc/tc04.jpg", "bdimg1": "ddc/hj04.jpg", "carname": "雅迪CH-60W", "bdcolor": "黄色", "cpnum": "G4545", "cjnum": "C8645", "fdjnum": "F1354", "bdimg2": "ddc/008.jpg", "other": "车把有黄色手套", "czname": "张亮", "sfzID": "325008198405244672", "czaddress": "长虹北路", "phone": "15953454633", "bdimg3": "ddc/jc04.jpg", "vedio": "ddc/shipin02.flv", "xyrtz": "戴黑色边框眼镜,身高1.7米左右", "state": "侦破", "admin": "姚民初" },

{ "id": "10", "name": "151030许云飞绿源电动车被盗", "begintime": "2015-10-30 12:58:00", "bdtime": "2015-10-30 15:48:00", "bdaddress": "大中路步行街", "gis": "115.996109,29.731215", "bdimg": "ddc/tc01.jpg", "bdimg1": "ddc/hj01.jpg", "carname": "绿源LC-50M", "bdcolor": "绿色", "cpnum": "G4647", "cjnum": "C4321", "fdjnum": "F1244", "bdimg2": "ddc/009.jpg", "other": "前面有车篮", "czname": "许云飞", "sfzID": "325008199310184958", "czaddress": "大中路步行街", "phone": "15628454855", "bdimg3": "ddc/jc01.jpg", "vedio": "ddc/shipin01.flv", "xyrtz": "黑色T血,鸭嘴帽,偏瘦", "state": "待侦", "admin": "吴飞" }
]
};

var fanglistdata = { "listdata": [
{ "id": "1", "title": "雅迪电动车、助力车销售行", "name": "吴斌", "phone": "13979278566", "postphone": "0792-336005", "gis": "116.004303,29.736834", "time": "2012-10-25", "address": "浔阳区滨江路685号", "img": "ddc/dian1.jpg", "count": "0" },
{ "id": "2", "title": "灯辉车行维修点", "name": "李耀辉", "phone": "13645852236", "postphone": "", "gis": "116.007579,29.73796", "time": "2011-11-20", "address": "滨江三支路12号", "img": "ddc/dian2.jpg", "count": "1" },
{ "id": "3", "title": "绿源电动车千峰店", "name": "王伟龙", "phone": "15145875963", "postphone": "", "gis": "116.08047,29.754694", "time": "2009-09-25", "address": "滨江路125号（金鸡坡）", "img": "ddc/dian3.jpg", "count": "0" },
{ "id": "4", "title": "滨江路绿源电动车", "name": "姚丽红", "phone": "18952634587", "postphone": "0792-338655", "gis": "116.087688,29.754647", "time": "2013-12-25", "address": "滨江路577号", "img": "ddc/dian4.jpg", "count": "3" },
{ "id": "5", "title": "甘棠北路绿源电动车销售行", "name": "汪明", "phone": "13978523364", "postphone": "0792-6358457", "gis": "116.003823,29.736231", "time": "2011-11-11", "address": "甘棠北路15号", "img": "ddc/dian5.jpg", "count": "2" },
{ "id": "6", "title": "滨江路民政局旁小刀电动车行", "name": "万启明", "phone": "13678425538", "postphone": "", "gis": "116.011349,29.740302", "time": "2014-10-25", "address": "浔阳区滨江路132号（民政局旁）", "img": "ddc/dian6.jpg", "count": "0" },
{ "id": "7", "title": "长虹北路雅迪电动车销售行", "name": "洪伟明", "phone": "15145856998", "postphone": "0792-452556", "gis": "116.023674,29.73254", "time": "2012-10-25", "address": "长虹北路233号", "img": "ddc/dian7.jpg", "count": "0" },
]
};
var mailistdata = { "listdata": [
{ "id": "1", "name": "董文杰", "bname": "文哥,秃子", "idcard":"423545196711258456","img": "ddc/mai1.jpg", "gis": "116.003823,29.736231", "address": "甘棠北路15号福明小区203室", "state": "高危", "time": "2015-11-15", "count": "5", "phone": "13907925685" },
{ "id": "2", "name": "汪如超", "bname": "汪建明", "idcard": "423545196711258456", "img": "ddc/mai2.jpg", "gis": "116.023674,29.73254", "address": "长虹北路化工厂宿舍2栋203室", "state": "惯犯", "time": "2015-11-15", "count": "2", "phone": "13698758569" }
]
};

var twlistdata = { "listdata": [
{ "id": "1", "title": "天网监控 DZD-012","gis": "115.994025,29.732218" },
{ "id": "2", "title": "天网监控 DZD-013", "gis": "115.997681,29.734413" },
{ "id": "3", "title": "天网监控 DZD-014", "gis": "115.998382,29.73468" },
{ "id": "4", "title": "天网监控 DZD-015", "gis": "115.99857,29.732908" },
{ "id": "5", "title": "天网监控 DZD-016", "gis": "115.999837,29.735135" },
{ "id": "6", "title": "天网监控 DZD-017", "gis": "116.001283,29.734335" },
{ "id": "7", "title": "天网监控 DZD-018", "gis": "116.003709,29.736671" },
{ "id": "8", "title": "天网监控 DZD-019", "gis": "116.004113,29.735111" },
{ "id": "9", "title": "天网监控 DZD-020", "gis": "116.007032,29.73497" },
{ "id": "10", "title": "天网监控 DZD-021", "gis": "116.012404,29.740113" },
{ "id": "11", "title": "天网监控 DZD-022", "gis": "116.015459,29.742943" },
{ "id": "12", "title": "天网监控 DZD-023", "gis": "115.996837,29.730031" }
]
};

//得到页面高度 
var pheight = (document.documentElement.scrollHeight > document.documentElement.clientHeight) ? document.documentElement.scrollHeight : document.documentElement.clientHeight;

//得到页面宽度 
var pwidth = (document.documentElement.scrollWidth > document.documentElement.clientWidth) ? document.documentElement.scrollWidth : document.documentElement.clientWidth;


/*获取一个指定对象*/
function id(idName) {
     return document.getElementById(idName);
}


/////页面跳转
function url(pagePath) {
    var rand = Math.random().toString().replace(".", "");
    if (pagePath.toString().indexOf("?") > 0) {
        pagePath += "&keyStr=" + rand.substring(1, 5);
    } else {
        pagePath += "?keyStr=" + rand.substring(1, 5);
    }
    window.location.href = pagePath;
}

//设置对象居中显示
var divHiddenID = "div_message_hidden"; //作为隐藏层的ID
var divMessageInfoID = "div_message_info";//显示内容区域的层
var spanMessageID = "span_message"; //标题提示的ID
var sureButtonID = "btnMessageSure"; //提交按钮ID
var cancelButtonID = "btnMessageCancel"; //取消按钮ID
var divShowObjectID = ""; //当前显示的对象ID
/**
 * 
 * @param {显示层的ID} objName 
 * @param {显示的标题} title 
 * @param {点击确定执行的事件} sureEvent 
 * @param {是否显示取消按钮} cancelShow 
 * @param {是否居中显示} showType 
 * @param {显示窗体的宽度} objWidth 
 * @param {显示窗体的高度} objHeight 
 * @returns {} 
 */
function DisplayOpen(objName, title, sureEvent,cancelShow,showType, objWidth, objHeight) {

    if (objWidth == undefined||objWidth==0) { objWidth = 480; }//0默认大小
    if (objHeight == undefined || objHeight == 0) { objHeight = 230; } //0默认大小
    if (objHeight > pheight) {objHeight = pheight - 40; }
    if (objWidth > pwidth) { objWidth = pwidth - 40; }
    if (objHeight < 200) { objHeight = 200; }
    if (objWidth < 350) { objWidth = 350; }
    id(divHiddenID).style.display = "block";
    //showType=true 居中显示  false top显示
    if (showType||showType==undefined||showType==null) {
        id(objName).style.left = parseInt(pwidth / 2 - objWidth / 2) + "px";
        id(objName).style.top = parseInt(pheight / 2 - objHeight / 2) + "px";
    } else {
        id(objName).style.left = parseInt(pwidth / 2 - objWidth / 2) + "px";
        id(objName).style.top = "42px";
    }
    if (divMessageInfoID != "") {
        id(divMessageInfoID).style.height = objHeight - 105 + "px";
    }
    if (title == "" || title == undefined||title==null) {
        title = "提示信息";
    }
    if (sureEvent != null && sureEvent != undefined) {
        id(sureButtonID).onclick = sureEvent;
    } else {
        id(sureButtonID).style.display = "none";
    }
    if (cancelButtonID != "") {
        id(cancelButtonID).onclick = DisplayClose;
    }
    if (!cancelShow) {
        id(cancelButtonID).style.display = "none";
    }
    id(spanMessageID).innerHTML = title;
    id(objName).style.width = objWidth + "px";
    id(objName).style.height = objHeight + "px";
    divShowObjectID = objName;
    setDisplay(objName, "block");
}
//关闭显示对象
function DisplayClose() {
    setDisplay(divShowObjectID, "none");
    id(divHiddenID).style.display = "none";
    divShowObjectID = "";
}

//设置显示 obj显示对象的ID名称 type=inline显示 none隐藏
function setDisplay(obj,type)
{
if(type=="block"){
   id(obj).style.display=type;
//   var count=0;
//   var outi=setInterval(function(){
//       id(obj).style.filter ="alpha(opacity="+count+")";
//       count=count+10;
//       if(count>=110){clearInterval(outi);}
//     },20);

} else {
    id(obj).style.display = type;
//     var cou=110;
//  var outs=setInterval(function(){
//    id(obj).style.filter ="alpha(opacity="+cou+")";
//       cou=cou-10;
//       if(cou<=0){clearInterval(outs);id(obj).style.display=type;}
//  },20);
  }
}
///获取父级框架元素
function getP() {
    return window.parent.window;
}


//清除所有Session
function CleanSession(){
    GetServer("post","ashx/SessionClean.aspx",null,function(){
       if(xmlHttp.readyState==4){
       }
    });
    return true;
}




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
  拖动定位模式为绝对定位的控件，在控件中 onmousedown="DragObject(this)";
*/

function DragObject(o) {
 var cursorLeft=event.x;
 var cursorTop = event.y;
 var left=o.style.left;
 var top=o.style.top;
 o.style.cursor = "move";
 o.onmousemove = function()  
        {  
            var ml=event.x;
            var mt=event.y;
            if(ml>=cursorLeft){
            o.style.left=parseInt(left)+(ml-cursorLeft)+"px";
            }else{
             o.style.left=parseInt(left)-(cursorLeft-ml)+"px";
            }
            if(mt>=cursorTop) {
                o.style.top = parseInt(top) + (mt - cursorTop) + "px";
            }else{
             o.style.top=parseInt(top)-(cursorTop-mt)+"px";
            }
        }  
 o.onmouseup = function()  
        {  
            o.style.cursor = "";
            o.onmousemove=null;  
            o.onmouseup=null;
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    拖动定位模式为绝对定位的控件，调用方法 drag(id);
    */

    function drag(o, s) {
        if (typeof o == "string") o = document.getElementById(o);
        o.orig_x = parseInt(o.style.left) - document.body.scrollLeft;
        o.orig_y = parseInt(o.style.top) - document.body.scrollTop;
        o.orig_index = o.style.zIndex;

        o.onmousedown = function (a) {
            this.style.cursor = "move";
            this.style.zIndex = 9999;
            var d = document;
            a = a || getEvent();
            var x = a.clientX + d.body.scrollLeft - o.offsetLeft;
            var y = a.clientY + d.body.scrollTop - o.offsetTop;
            //author: www.longbill.cn  
            d.ondragstart = "return false;"
            d.onselectstart = "return false;"
            d.onselect = "document.selection.empty();"

            if (o.setCapture)
                o.setCapture();
            else if (window.captureEvents)
                window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP);

            d.onmousemove = function (a) {
                a = a || getEvent();
                o.style.left = a.clientX + document.body.scrollLeft - x + "px";
                o.style.top = a.clientY + document.body.scrollTop - y + "px";
                o.orig_x = parseInt(o.style.left) - document.body.scrollLeft;
                o.orig_y = parseInt(o.style.top) - document.body.scrollTop;
                if (parseInt(o.style.left) < 0) {
                    o.style.left = "0px";
                } if (parseInt(o.style.top) < 0) {
                    o.style.top = "0px";
                }
            }

            d.onmouseup = function () {
                if (o.releaseCapture)
                    o.releaseCapture();
                else if (window.captureEvents)
                    window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP);
                d.onmousemove = null;
                d.onmouseup = null;
                d.ondragstart = null;
                d.onselectstart = null;
                d.onselect = null;
                o.style.cursor = "normal";
                o.style.zIndex = o.orig_index;
            }
        }

        if (s) {
            var orig_scroll = window.onscroll ? window.onscroll : function () { };
            window.onscroll = function () {
                orig_scroll();
                o.style.left = o.orig_x + document.body.scrollLeft;
                o.style.top = o.orig_y + document.body.scrollTop;
                if (parseInt(o.style.left) < 0) {
                    o.style.left = "0px";
                } if (parseInt(o.style.top) < 0) {
                    o.style.top = "0px";
                }
            }
        }
    }

    //获取当前活动的对象 兼容各大浏览器
    function getObject() {
        var eve = getEvent();
        if (eve == null) {
            return null;
        }
        return eve.srcElement ? eve.srcElement : eve.target;
    }
    //获取event事件 兼容各大浏览器
    function getEvent() //同时兼容ie和ff的写法 
    {
        if (document.all) return window.event;
        func = getEvent.caller;
        while (func != null) {
            var arg0 = func.arguments[0];
            if (arg0) {
                if ((arg0.constructor == Event || arg0.constructor == MouseEvent) || (typeof (arg0) == "object" && arg0.preventDefault && arg0.stopPropagation)) {
                    return arg0;
                }
            }
            func = func.caller;
        }
        return null;
    }

    //阻止冒泡的方法  调用 onmousedown="stopDrag"; 
    function stopDrag() {
        var evt = getEvent();
        //IE用cancelBubble=true来阻止而FF下需要用stopPropagation方法  
        evt.stopPropagation ? evt.stopPropagation() : (evt.cancelBubble = true);
    }

    ///显示加载进度提示  isT=true显示 false隐藏
    function showLoad(isT) {
        if (isT) {
            id("div_Loading").style.display = "block";
        } else {
            id("div_Loading").style.display = "none";
        }
    }

    ///判断当前执行的是否这个界面 pageName是一个完整的界面名称如（index.aspx） 
    function IsPage(pageName) {
        if (window.location.href.toString().indexOf(pageName) >= 0) {
            return true;
        }
        return false;
    }
    ///获取当前页面的url参数 
    /// name 为参数的key
    function GetQueryString(name) {
        var r = window.location.search.substr(1);
        r = r.split('&');
        var value = "";
        for (var i = 0; i < r.length; i++) {
            var lit = r[i].split('=');
            if (lit[0] == name) {
                for (var j = 1; j < lit.length; j++) {
                    value += lit[j] + "=";
                }
                break;
            }
        }
        if (value != "") { value = value.substring(0, value.length - 1); }
        else {
            value = null;
        }
        return value;
        //    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        //    var r = window.location.search.substr(1).match(reg);
        //    if (r != null) return (r[2]); return null;

    }



    var pageIndexValue = 0; //当前页的值
    var pageCountValue = 0; //总页数的值
    var pageObject; //执行分页的函数
    var pageButtoID = 1; //页码的按钮ID索引 从1-5
    var isPageFull = false; //是否刷新页码
    ///分页加载 pageCount数据源总行数  pageSize每页显示的行数 fun回调数据的函数
    function PageLoad(pageCount, pageSize, fun) {
        PageShow(true);
        pageObject = fun;
        var row = parseInt(parseInt(pageCount) / parseInt(pageSize)); //共多少页
        var _row = parseInt(pageCount) % parseInt(pageSize); //有余数加一页
        if (_row > 0) { row = row + 1; } //当余数大于0需要加一页
        pageCountValue = row;
        id("pagecount").innerHTML = pageCount;
        id("pagesize").innerHTML = pageSize;
        id("pageindex").innerHTML = pageIndexValue + 1;
        id("pageZONG").innerHTML = row;
        //总页数大于1需要显示分页
        if (pageCountValue > 1) {
            LoadPageStyle(); //加载分页控件样式
        }
    }
    //隐藏分页
    function PageShow(bool) {
        if (bool) {
            id("div_pagecontent").style.display = "block";
        } else {
            id("div_pagecontent").style.display = "none";
        }
    }

    //加载分页样式
    function LoadPageStyle() {
        if (id("div_page").innerHTML == "" || isPageFull) {
            pageIndexValue = 0;
            var pHTML = "<ul class='paginList'>";
            pHTML += "<li class='paginItem'><a href='#' onclick='UpPageData();'><span class='pagepre'></span></a></li>"; //上一页
            for (var i = 1; i <= pageCountValue; i++) {
                if (i == 6) {
                    //超出了5页的最高范围了
                    if (pageCountValue - 6 > 0) {
                        pHTML += "<li class='paginItem more'><a href='#'>...</a></li>";
                    }
                    pHTML += "<li id='pageli" + pageCountValue + "' class='paginItem'><a href='#' onclick='ThisPageData(this," + pageCountValue + ");'>" + pageCountValue + "</a></li>";
                    break;
                } else {
                    pHTML += "<li id='pageli" + i + "' class='paginItem'><a href='#' onclick='ThisPageData(this," + i + ");'>" + i + "</a></li>";
                }
            }
            pHTML += "<li class='paginItem'><a href='#' onclick='UbPageData();'><span class='pagenxt'></span></a></li>";
            pHTML += "</ul>";
            id("div_page").innerHTML = pHTML;
        }
        var row = pageIndexValue + 1; //当前显示的页码

        if (pageCountValue > 5) {
            //点击的是页码按钮第一个
            if (pageButtoID == 1) {
                //每个页码减3
                if (row > 3) {
                    pageButtoID = pageButtoID + 3;
                    for (var i = 1; i <= 5; i++) {
                        id("pageli" + i).getElementsByTagName("a")[0].innerHTML = parseInt(id("pageli" + i).getElementsByTagName("a")[0].innerHTML) - 3;
                    }
                }
            }
            //点击的是页码按钮最后一个
            if (pageButtoID == 5) {
                var manp = pageCountValue - row; //必须大于1 
                if (manp > 1) {
                    var jcount = 3;
                    if (manp == 2) {
                        jcount = 1;
                    }
                    if (manp == 3) {
                        jcount = 2;
                    }
                    pageButtoID = pageButtoID - jcount;
                    for (var i = 1; i <= 5; i++) {
                        id("pageli" + i).getElementsByTagName("a")[0].innerHTML = parseInt(id("pageli" + i).getElementsByTagName("a")[0].innerHTML) + jcount;

                    }
                }
            }
        }
        //点击了最后一页
        if (pageButtoID == pageCountValue && pageCountValue > 5) {
            var jcount = pageCountValue - 6;
            for (var i = 1; i <= 5; i++) {
                id("pageli" + i).getElementsByTagName("a")[0].innerHTML = jcount + i;
            }
        }


        for (var i = 1; i <= 5; i++) {
            try {
                var ins = id("pageli" + i).getElementsByTagName("a")[0].innerHTML;
                id("pageli" + i).className = "paginItem";
                id("pageli" + pageCountValue).className = "paginItem";
                if ((pageIndexValue + 1) == parseInt(ins)) {
                    id("pageli" + i).className = "paginItem current";
                }

            } catch (e) {

            }
        }
        if (pageCountValue - row == 0) { id("pageli" + pageCountValue).className = "paginItem current"; }
    }
    //上一页
    function UpPageData() {
        if (pageIndexValue == 0) { alert("已是第一页！"); }
        else {
            pageButtoID--;
            if (pageIndexValue + 1 == pageCountValue) {
                pageButtoID = 5;
            }
            pageIndexValue--;
            pageObject(pageIndexValue);
        }
    }
    //下一页
    function UbPageData() {
        if (pageIndexValue + 1 == pageCountValue) { alert("已是最后一页！"); }
        else {
            pageButtoID++;
            pageIndexValue++;
            pageObject(pageIndexValue);
        }
    }
    //点击当前页
    function ThisPageData(at, pageid) {
        pageButtoID = pageid;
        pageIndexValue = parseInt(at.innerHTML) - 1;
        pageObject(pageIndexValue);
    }


    ///匹配后的内容
    function Replace(str, oldstr, newstr) {
        var reg = new RegExp(oldstr, "g");
        var stringObj = str;
        var newstring = stringObj.replace(reg, newstr);
        return newstring;
    }

///文本框错误提示
function ErrorInput(inputId,errorMes) {
    var count = 0;
    var inputObject = id(inputId);
    var oldColor = inputObject.style.color;
    var oldValue = inputObject.value;
    var oldType = inputObject.type;
    if (errorMes != undefined) {
        inputObject.style.color = "Red";
        inputObject.value = errorMes;
        inputObject.type = "text";
    }
    var ints = setInterval(function () {
        if (count < 4) {
            if (count % 2 == 0) {
                inputObject.style.border = "1px solid Red";
            } else {
                inputObject.style.border = "";
            }
        } else if (count >= 4 && count < 8) {
            inputObject.style.border = "1px solid Red";
        } else {
            inputObject.style.border = "";
            inputObject.style.color = oldColor;
            inputObject.type = oldType;
            var newValue = inputObject.value;
            if (newValue != oldValue) {
                if (newValue != errorMes) {
                    inputObject.value = newValue;
                } else {
                    inputObject.value = oldValue;
                }
            } else {
                inputObject.value = oldValue;
            }
            clearInterval(ints);
        }
        count++;
    }, 200);
}

///获取指定框架下指定标签元素的集合
function GetFrameArrayList(arrayName) {
    var array = window.parent.frames["lFrame"].document.getElementsByTagName(arrayName);
    return array;
}
//获取父级框架指定的标签元素集合
function GetTopFrameArrayList(ArrayName) {
    var array = window.top.frames["topFrame"].document.getElementsByTagName(ArrayName);
    return array;
}
///触发指定元素的点击事件
//pageName=打开的界面名称  level=0父级 1同级
function OpenPage(pageName, level) {
    if (level == undefined) {
        level = 1;
    }
    var ArrayListData;
    if (level == 0) {
        ArrayListData = GetTopFrameArrayList("a");
    } else {
        ArrayListData = GetFrameArrayList("a");
    }
    for (var i = 0; i < ArrayListData.length; i++) {
        if (ArrayListData[i].innerHTML.indexOf(pageName)>=0) {
            ArrayListData[i].click();
            break;
        }
    }
}

///打开地图选择坐标位置
function SelectGIS() {
    var obj = getObject();
    obj.blur();
    isForm = true;
    FormWidth = 900;
    FormHeight = 500;
    OpenForm("../gisselect.html?id=" + obj.id, "点击选择GIS坐标");
}
//选择坐标后赋值
function SelectGISValue(xy) {
    var idname = GetQueryString("id");
    getP().id(idname).value = xy;
    getP().CloseForm();
}

    /// <summary>         
    /// 生成视频播放器的HTML源码         
    /// </summary>                
    /// <param name="strUrl">视频存放路径只支持 flv avi wmv 三种格式</param>
    /// <param name="title">视频标题</param>
    /// <param name="strWidth">播放器宽度</param>         
    /// <param name="strHeight">播放器高度</param>         
    /// <param name="AutoPlay">是否自动播放 0不播放 1播放</param>
    /// <returns></returns>         
    function GetPlayHtml(strUrl, title,  strWidth,  strHeight, AutoPlay,flvPath)
    {
        var xl = strUrl.split('.')[strUrl.split('.').length - 1];
        var html = "";
        switch (xl.toLocaleUpperCase())
        {
            case "FLV":
                html = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='"+strWidth+"' height='"+strHeight+"'>" +
                         "<param name='movie' value='"+flvPath+"player.swf'>" +
                         "<param name='quality' value='high'>" +
                         "<param name='allowFullScreen' value='true' />" +
                         "<param name='FlashVars' value='vcastr_file=" + strUrl + "&vcastr_title=" + title + "&BarColor=0x323232&BarPosition=1&IsAutoPlay="+AutoPlay+"&IsContinue=1' />" +
                         "<embed src='player.swf' allowFullScreen='true' FlashVars='vcastr_file=" + strUrl + "&vcastr_title=" + title + "&BarColor=0x323232&BarPosition=1&IsAutoPlay="+AutoPlay+"&IsContinue=1' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='"+strWidth+"' height='"+strHeight+"'></embed></object>";
                break;
            case "AVI":
            case "WMV":
                html = "<object classid='clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95'  width='" + strWidth + "' height='" + strHeight + "' hspace='0' vspace='0' id='MusicBox'  >"
        + "<param name='AudioStream' value='-1'>"
        + "<param name='AudioStream' value='-1'>"
        + "<param name='AutoSize' value='-1'>"
        + "<param name='AutoStart' value='-1'>"
        + "<param name='AnimationAtStart' value='-1'>"
        + "<param name='AllowScan' value='-1'>"
        + "<param name='AllowChangeDisplaySize' value='-1'>"
        + "<param name='AutoRewind' value='0'>"
        + "<param name='Balance' value='0'>"
        + "<param name='BaseURL' value>"
        + "<param name='BufferingTime' value='5'>"
        + "<param name='CaptioningID' value>"
        + "<param name='ClickToPlay' value='-1'>"
        + "<param name='CursorType' value='0'>"
        + "<param name='CurrentPosition' value='-1'>"
        + "<param name='CurrentMarker' value='0'>"
        + "<param name='DefaultFrame' value>"
        + "<param name='DisplayBackColor' value='0'>"
        + "<param name='DisplayForeColor' value='16777215'>"
        + "<param name='DisplayMode' value='0'>"
        + "<param name='DisplaySize' value='50%'>"
        + "<param name='Enabled' value='-1'>"
        + "<param name='EnableContextMenu' value='-1'>"
        + "<param name='EnablePositionControls' value='-1'>"
        + "<param name='EnableFullScreenControls' value='0'>"
        + "<param name='EnableTracker' value='-1'>"
        + "<param name='Filename' value='"+strUrl+"'>"
        + "<param name='InvokeURLs' value='-1'>"
        + "<param name='Language' value='-1'>"
        + "<param name='Mute' value='0'>"
        + "<param name='PlayCount' value='1'>"  //0循环播放 其它为固定播放次数
        + "<param name='PreviewMode' value='0'>"
        + "<param name='Rate' value='1'>"
        + "<param name='SAMILang' value>"
        + "<param name='SAMIStyle' value>"
        + "<param name='SAMIFileName' value>"
        + "<param name='SelectionStart' value='-1'>"
        + "<param name='SelectionEnd' value='-1'>"
        + "<param name='SendOpenStateChangeEvents' value='-1'>"
        + "<param name='SendWarningEvents' value='-1'>"
        + "<param name='SendErrorEvents' value='-1'>"
        + "<param name='SendKeyboardEvents' value='0'>"
        + "<param name='SendMouseClickEvents' value='0'>"
        + "<param name='SendMouseMoveEvents' value='0'>"
        + "<param name='SendPlayStateChangeEvents' value='-1'>"
        + "<param name='ShowCaptioning' value='0'>"
        + "<param name='ShowControls' value='1'>"
        + "<param name='ShowAudioControls' value='0'>"
        + "<param name='ShowDisplay' value='0'>"
        + "<param name='ShowGotoBar' value='0'>"
        + "<param name='ShowPositionControls' value='0'>"
        + "<param name='ShowStatusBar' value='0'>"
        + "<param name='ShowTracker' value='0'>"
        + "<param name='TransparentAtStart' value='0'>"
        + "<param name='VideoBorderWidth' value='0'>"
        + "<param name='VideoBorderColor' value='0'>"
        + "<param name='VideoBorder3D' value='0'>"
        + "<param name='Volume' value='-320'>"
        + "<param name='WindowlessVideo' value='0'>"
        + "</object> ";
                break;
            default:
                html = "";
                break;
        }
        return html;
    }