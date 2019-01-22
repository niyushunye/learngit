/*
  获取确实的_load.js文件接口地址：http://api0.map.bdimg.com/getmodules?v=2.0&t=20140707&mod=这里是确实的js文件名称

  当前js主要处理离线百度地图的外部文件加载
  并且实现百度地图功能的处理

  创建日期：2015-12-04
  开发者：YTW
*/


/*
全局配置参数列表
*/
// var APIPATH = "../mapapi/"; //api部署的服务器地址 最后包含/哦
var APIPATH = "../../../../map/mapapi/"; //api部署的服务器地址 最后包含/哦
var APIIMAGESFILENAME = "images"; //api中图标文件存放的文件夹名称
var APIOVERLAYFILENAME = "overlay"; //api离线瓦片图存放的文件夹名称
var APIOVERLATYIMAGETYPE = "png"; //api离线瓦片图图片格式
/*如果浏览器不兼容，请过滤掉不兼容的浏览器 
默认有： MSIE=IE7-IE9, Windows=IE10或以上, Firefox=火狐, Chrome=360, Opera=欧朋, Safari=苹果
*/
var APIBROWSERTYPE = ["MSIE", "Windows","Chrome"]; //需要过滤的就手动加载进来 请注意大小写哦

/*
   存储离线地图图片集合
*/
var MapImagePath=[];
/*
加载外部文件关联数量
*/
var LoadFileCount = 3;  //加载外部文件的总数量
var LoadFileThisCount = 0; //当前加载文件的数量 默认从0开始


/*
 * 动态加载外部文件的函数
 * url 文件的地址
 * callback 加载完成后执行的函数
*/
function LoadScriptOrCss(url, callback) {
    var urlpst = url.split('.')[url.split('.').length - 1].toUpperCase();
    if (urlpst == "JS") {
        var script = document.createElement("script")
        script.type = "text/javascript";
        if (script.readyState) {  //IE
            script.onreadystatechange = function () {
                if (script.readyState == "loaded" || script.readyState == "complete") {
                    script.onreadystatechange = null;
                    callback();
                }
            };
        } else {  //Others
            script.onload = function () {
                callback();
            };
        }
        script.src = url;
        document.getElementsByTagName("head")[0].appendChild(script);
    }
    if (urlpst == "CSS") {
        var css = document.createElement("link")
        css.type = "text/css";
        if (css.readyState) {  //IE
            css.onreadystatechange = function () {
                if (css.readyState == "loaded" || css.readyState == "complete") {
                    css.onreadystatechange = null;
                    callback();
                }
            };
        } else {  //Others
            css.onload = function () {
                callback();
            };
        }
        css.href = url;
        css.rel = "stylesheet";
        document.getElementsByTagName("head")[0].appendChild(css);
    } 
}


/*
初始化百度地图第一步调用 
例如
LoadApi(function(){
   //初始化成功后加载的函数代码
});
*/
function LoadApi(callFun) {
    LoadScriptOrCss(APIPATH + "js/BaiduApi_2.0.js", function () { LoadFileThisCount++; });
    LoadScriptOrCss(APIPATH + "css/baidu.css", function () { LoadFileThisCount++; });
    var inttime = setInterval(function () {
       /////说明下这里为什么减2 是因为if里面加载了外部文件2个，按照下面手机的加载文件来减
        if (LoadFileCount - 1 == LoadFileThisCount) {
            clearInterval(inttime);
            LoadScriptOrCss(APIPATH + "js/InfoBox.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/RectangleZoom_min.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/DistanceTool_min.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/LuShu.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/Heatmap_min.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/TextIconOverlay_min.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/MarkerClusterer_min.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/CurveLine.min.js", function () { LoadFileThisCount++; });
            //LoadScriptOrCss(APIPATH + "js/GPStoBaiduXY.js", function () { LoadFileThisCount++; });
            var intload = setInterval(function () {
                if (LoadFileCount == LoadFileThisCount) {
                    clearInterval(intload);
                    callFun();
                }
            }, 20);
        }
    }, 20);
}

//初始化到中心点 LNG,LAT坐标位置  Zoom默认显示级别
function InitCenterAndZoom(map,lng,lat,Zoom) {
    var point = new BMap.Point(lng, lat);  //设置地图中心点经度纬度
    map.centerAndZoom(point, Zoom);
}

//默认地图类型 必须选择项 minZooms=地图显示最小级别  maxZooms地图显示最大级别
function getDefaultMapType(minZooms,maxZooms) {
    // 离线瓦片
    if (minZooms == undefined) { minZooms = 1; }
    if (maxZooms == undefined) {maxZooms = 18;}
    var tileLayer = new BMap.TileLayer();
    tileLayer.getTilesUrl = function (tileCoord, zoom) {
        var x = tileCoord.x;
        var y = tileCoord.y;
        //var gx = toGoogleX(x,zoom);//谷歌地图转换
        //var gy = toGoogleY(y,zoom);//谷歌地图转换
//var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + gx + "/" + gy + "." + APIOVERLATYIMAGETYPE; //直接使用本地瓦片        
var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + x + "/" + y + "." + APIOVERLATYIMAGETYPE; //直接使用本地瓦片
        //document.getElementById("info_div").innerHTML+=url+"<br/>";
      return url;
    }
    var myType = new BMap.MapType('MyMap', tileLayer, {
        minZoom: minZooms,
        maxZoom: maxZooms
    });
    var weixing = BMAP_HYBRID_MAP;
    return myType;
}

///加载离线瓦片图
function LoadOverlayImage(map) {
    var overlayTileLayer = new BMap.TileLayer({ isTransparentPng: true });
    overlayTileLayer.getTilesUrl = function (tileCoord, zoom) {
        var x = tileCoord.x;
        var y = tileCoord.y;
        //var gx = toGoogleX(x,zoom);//谷歌地图转换
        //var gy = toGoogleY(y,zoom);//谷歌地图转换
        //var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + gx + "/" + gy + "." + APIOVERLATYIMAGETYPE; //直接使用本地瓦片,根据当前坐标，选取合适的瓦片图,不建议此方法,会导致拖动的时候卡顿,建议直接使用百度瓦片
        var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + x + "/" + y + "." + APIOVERLATYIMAGETYPE; //直接使用本地瓦片
        //document.getElementById("info_div").innerHTML+=url+"<br/>";                 
        if (isOverView) { MapImagePath.push(url); }
        return url;
    }
    map.addTileLayer(overlayTileLayer);
}

//显示缩放控件
function ShowControl(map,type) {
    //添加缩放控件
    var types = BMAP_ANCHOR_TOP_RIGHT;
    if (type != undefined) { types = BMAP_ANCHOR_TOP_LEFT; }
    map.addControl(new BMap.NavigationControl({
        anchor: types,
        type: BMAP_NAVIGATION_CONTROL_LARGE
    }));
}

/////显示比例尺
//map=地图对象   type=0左上角 1右上角 2左下角 3右下角 不带值默认0
function ShowScale(map,type)
{
     if(type==undefined){type=0;}
     var showType=BMAP_ANCHOR_TOP_LEFT;
     if (type == 1) { showType = BMAP_ANCHOR_TOP_RIGHT; }
     if (type == 2) { showType = BMAP_ANCHOR_BOTTOM_LEFT; }
     if (type == 3) { showType = BMAP_ANCHOR_BOTTOM_RIGHT; }
     var top_left_control = new BMap.ScaleControl({ anchor: showType }); // 左上角，添加比例尺
     map.addControl(top_left_control);
 }
 ////显示鹰眼  o= 地图控件ID
 var imgpathstop = "";
 var isOverView = false;//是否显示了鹰眼
 function ShowOverview(map, o) {
     isOverView = true;
     var overViewOpen = new BMap.OverviewMapControl({ isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT });
     map.addControl(overViewOpen);
     if (document.getElementById(o).onmousemove == null) {
         document.getElementById(o).onmousemove = function () {
             if (MapImagePath.length > 0) {
                 imgpathstop = MapImagePath[0];
             }
             //alert(getElementsByClassName('BMap_omMapContainer').innerHTML);
             //BMap_omMapContainer  BMap_omViewMask
             try { getElementsByClassName('BMap_omMapContainer').innerHTML = "<img src='" + imgpathstop + "'/>"; } catch (e) { }
             MapImagePath.length = 0;
         }
     }
 }

 //获取class的对象
 function getElementsByClassName(n) {
     var classElements = [], allElements = document.getElementsByTagName('*');
     for (var i = 0; i < allElements.length; i++) {
         if (allElements[i].className == n) {
             classElements[classElements.length] = allElements[i];
         }
     }
     return classElements[0];
 }


//显示鼠标放大缩小
function ShowZoom(map) {
    map.enableContinuousZoom(); //放大缩小样式
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    map.enableScrollWheelZoom(); //启用滚轮放大缩小
}
////地图缩小放大事件
function ZoomEvent(map, callFun) {
    map.addEventListener('zoomend', function (e) {
        callFun(e);
    });
}
//得到地图缩放级别
function getZoom(map) {
    return map.getZoom();
}
//得到地图中心点
function getCenter(map) {
    var ct = map.getCenter();
    return ct.lng + "," + ct.lat;
}

//重置缩放级别和中心点
function resetZoomAndCenter(map, zoom, lng, lat) {
    map.setZoom(zoom);
    map.setCenter(new BMap.Point(lng, lat));
}


//添加标注点  lng,lat=经纬度坐标 ico=标注显示的图片 icoWidth=标注图片宽度 icoHeight=标注图片的高度  text=显示的提示文本，borderColor=文本边框的颜色 fontColor=文本颜色 fontSize=字体大小
function SetMarker(map, lng, lat, ico, icoWidth, icoHeight, Text, borderColor, fontColor, fontSizes) {
    var point = new BMap.Point(lng, lat);
    var MarkerList = []; ///把添加的标注放到集合中去
    var marker;
    if (ico != undefined && ico != "") {
        var icons = new BMap.Icon(ico, new BMap.Size(icoWidth, icoHeight));
        marker = new BMap.Marker(point, { icon: icons }); //初始化地图标记
    } else {
        marker = new BMap.Marker(point); //初始化地图标记
    }
    map.addOverlay(marker); //将标记添加到地图中
    MarkerList.push(marker);
    if (Text != undefined && Text != "") {
        var opts = {
            position: point,    // 指定文本标注所在的地理位置
            offset: new BMap.Size(10, -30)    //设置文本偏移量
        }
        var label = new BMap.Label("&nbsp;" + Text + "&nbsp;", opts);  // 创建文本标注对象
        label.setStyle({
            color: fontColor,
            border: "1px solid " + borderColor,
            fontSize: fontSizes + "px",
            height: "20px",
            lineHeight: "20px",
            fontFamily: "微软雅黑"
        });
        map.addOverlay(label);
        MarkerList.push(label);
    }
    return MarkerList;
}

var infoWins = null;
//添加坐标点击弹出层  content=显示的内容  marker=标注对象  Style=样式
function addClickHandler(map, content, marker, Style) {
    var infoWin = new BMapLib.InfoBox(map, content, Style);
    marker.addEventListener("click", function (e) {
        var p = e.target;
        var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
        if (infoWins != null) { infoWins.close(); } //加上此代码控制每次只允许弹出一个层
        infoWins = infoWin;
        infoWin.open(point);
    }
		);
    infoWin.addEventListener("close", function (e) {
        infoWins = null;
    });
}

///开启画区域
function Drawing(map,drawingStyle,callFun) {
    //实例化鼠标绘制工具
    var drawingManager = new BMapLib.DrawingManager(map, drawingStyle);
    //添加鼠标绘制工具监听事件，用于获取绘制结果
    drawingManager.addEventListener('overlaycomplete', callFun);
    return drawingManager;
}

///锁定地图  isLoad=true锁定 false取消锁定
function LockMap(map,isLoad)
{
    if(isLoad){
       map.disableDragging();
    }else{
      map.enableDragging();
    }
}



/*
 谷歌瓦片图转换
*/
var baiduX = new Array(0, 0, 1, 3, 6, 12, 24, 49, 98, 197, 395, 790, 1581, 3163, 6327, 12654, 25308, 50617);
var baiduY = new Array(0, 0, 0, 1, 2, 4, 9, 18, 36, 73, 147, 294, 589, 1178, 2356, 4712, 9425, 18851);
var googleX = new Array(0, 1, 3, 7, 13, 26, 52, 106, 212, 425, 851, 1702, 3405, 6811, 13623, 27246, 54492, 107917);
var googleY = new Array(0, 0, 1, 2, 5, 12, 23, 47, 95, 190, 380, 761, 1522, 3045, 6091, 12183, 24366, 47261);

/*
  谷歌地图瓦片图转换
*/
function toGoogleX(x, z) {
    var b = baiduX[z - 1]; //395
    var g = googleX[z - 1]; //11:843,12:1685
    var gx = g + (x - b); //   --- 1587+
    //谷歌瓦片行编号=[谷歌参照瓦片行编号+(百度行编号 – 百度参照瓦片行编号)]
    return gx;
}
function toGoogleY(y, z) {
    var b = baiduY[z - 1]; //147
    var g = googleY[z - 1]; //10:
    var gy = g - (y - b); //
    //谷歌瓦片列编号=[谷歌参照瓦片列编号- (百度列编号 – 百度参照瓦片列编号)] //向上，列为递减
    //alert(y);
    return gy;
}





function obj2string(o) {
    var r = [];
    if (typeof o == "string") {
        return "\"" + o.replace(/([\'\"\\])/g, "\\$1").replace(/(\n)/g, "\\n").replace(/(\r)/g, "\\r").replace(/(\t)/g, "\\t") + "\"";
    }
    if (typeof o == "object") {
        if (!o.sort) {
            for (var i in o) {
                r.push(i + ":" + obj2string(o[i]));
            }
            if (!!document.all && !/^\n?function\s*toString\(\)\s*\{\n?\s*\[native code\]\n?\s*\}\n?\s*$/.test(o.toString)) {
                r.push("toString:" + o.toString.toString());
            }
            r = "{" + r.join() + "}";
        } else {
            for (var i = 0; i < o.length; i++) {
                r.push(obj2string(o[i]))
            }
            r = "[" + r.join() + "]";
        }
        return r;
    }
    return o.toString();
}
