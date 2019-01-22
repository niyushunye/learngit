/*
  ��ȡȷʵ��_load.js�ļ��ӿڵ�ַ��http://api0.map.bdimg.com/getmodules?v=2.0&t=20140707&mod=������ȷʵ��js�ļ�����

  ��ǰjs��Ҫ�������߰ٶȵ�ͼ���ⲿ�ļ�����
  ����ʵ�ְٶȵ�ͼ���ܵĴ���

  �������ڣ�2015-12-04
  �����ߣ�YTW
*/


/*
ȫ�����ò����б�
*/
// var APIPATH = "../mapapi/"; //api����ķ�������ַ ������/Ŷ
var APIPATH = "../../../../map/mapapi/"; //api����ķ�������ַ ������/Ŷ
var APIIMAGESFILENAME = "images"; //api��ͼ���ļ���ŵ��ļ�������
var APIOVERLAYFILENAME = "overlay"; //api������Ƭͼ��ŵ��ļ�������
var APIOVERLATYIMAGETYPE = "png"; //api������ƬͼͼƬ��ʽ
/*�������������ݣ�����˵������ݵ������ 
Ĭ���У� MSIE=IE7-IE9, Windows=IE10������, Firefox=���, Chrome=360, Opera=ŷ��, Safari=ƻ��
*/
var APIBROWSERTYPE = ["MSIE", "Windows","Chrome"]; //��Ҫ���˵ľ��ֶ����ؽ��� ��ע���СдŶ

/*
   �洢���ߵ�ͼͼƬ����
*/
var MapImagePath=[];
/*
�����ⲿ�ļ���������
*/
var LoadFileCount = 3;  //�����ⲿ�ļ���������
var LoadFileThisCount = 0; //��ǰ�����ļ������� Ĭ�ϴ�0��ʼ


/*
 * ��̬�����ⲿ�ļ��ĺ���
 * url �ļ��ĵ�ַ
 * callback ������ɺ�ִ�еĺ���
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
��ʼ���ٶȵ�ͼ��һ������ 
����
LoadApi(function(){
   //��ʼ���ɹ�����صĺ�������
});
*/
function LoadApi(callFun) {
    LoadScriptOrCss(APIPATH + "js/BaiduApi_2.0.js", function () { LoadFileThisCount++; });
    LoadScriptOrCss(APIPATH + "css/baidu.css", function () { LoadFileThisCount++; });
    var inttime = setInterval(function () {
       /////˵��������Ϊʲô��2 ����Ϊif����������ⲿ�ļ�2�������������ֻ��ļ����ļ�����
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

//��ʼ�������ĵ� LNG,LAT����λ��  ZoomĬ����ʾ����
function InitCenterAndZoom(map,lng,lat,Zoom) {
    var point = new BMap.Point(lng, lat);  //���õ�ͼ���ĵ㾭��γ��
    map.centerAndZoom(point, Zoom);
}

//Ĭ�ϵ�ͼ���� ����ѡ���� minZooms=��ͼ��ʾ��С����  maxZooms��ͼ��ʾ��󼶱�
function getDefaultMapType(minZooms,maxZooms) {
    // ������Ƭ
    if (minZooms == undefined) { minZooms = 1; }
    if (maxZooms == undefined) {maxZooms = 18;}
    var tileLayer = new BMap.TileLayer();
    tileLayer.getTilesUrl = function (tileCoord, zoom) {
        var x = tileCoord.x;
        var y = tileCoord.y;
        //var gx = toGoogleX(x,zoom);//�ȸ��ͼת��
        //var gy = toGoogleY(y,zoom);//�ȸ��ͼת��
//var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + gx + "/" + gy + "." + APIOVERLATYIMAGETYPE; //ֱ��ʹ�ñ�����Ƭ        
var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + x + "/" + y + "." + APIOVERLATYIMAGETYPE; //ֱ��ʹ�ñ�����Ƭ
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

///����������Ƭͼ
function LoadOverlayImage(map) {
    var overlayTileLayer = new BMap.TileLayer({ isTransparentPng: true });
    overlayTileLayer.getTilesUrl = function (tileCoord, zoom) {
        var x = tileCoord.x;
        var y = tileCoord.y;
        //var gx = toGoogleX(x,zoom);//�ȸ��ͼת��
        //var gy = toGoogleY(y,zoom);//�ȸ��ͼת��
        //var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + gx + "/" + gy + "." + APIOVERLATYIMAGETYPE; //ֱ��ʹ�ñ�����Ƭ,���ݵ�ǰ���꣬ѡȡ���ʵ���Ƭͼ,������˷���,�ᵼ���϶���ʱ�򿨶�,����ֱ��ʹ�ðٶ���Ƭ
        var url = APIPATH + APIOVERLAYFILENAME + '/' + (zoom) + "/" + x + "/" + y + "." + APIOVERLATYIMAGETYPE; //ֱ��ʹ�ñ�����Ƭ
        //document.getElementById("info_div").innerHTML+=url+"<br/>";                 
        if (isOverView) { MapImagePath.push(url); }
        return url;
    }
    map.addTileLayer(overlayTileLayer);
}

//��ʾ���ſؼ�
function ShowControl(map,type) {
    //������ſؼ�
    var types = BMAP_ANCHOR_TOP_RIGHT;
    if (type != undefined) { types = BMAP_ANCHOR_TOP_LEFT; }
    map.addControl(new BMap.NavigationControl({
        anchor: types,
        type: BMAP_NAVIGATION_CONTROL_LARGE
    }));
}

/////��ʾ������
//map=��ͼ����   type=0���Ͻ� 1���Ͻ� 2���½� 3���½� ����ֵĬ��0
function ShowScale(map,type)
{
     if(type==undefined){type=0;}
     var showType=BMAP_ANCHOR_TOP_LEFT;
     if (type == 1) { showType = BMAP_ANCHOR_TOP_RIGHT; }
     if (type == 2) { showType = BMAP_ANCHOR_BOTTOM_LEFT; }
     if (type == 3) { showType = BMAP_ANCHOR_BOTTOM_RIGHT; }
     var top_left_control = new BMap.ScaleControl({ anchor: showType }); // ���Ͻǣ���ӱ�����
     map.addControl(top_left_control);
 }
 ////��ʾӥ��  o= ��ͼ�ؼ�ID
 var imgpathstop = "";
 var isOverView = false;//�Ƿ���ʾ��ӥ��
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

 //��ȡclass�Ķ���
 function getElementsByClassName(n) {
     var classElements = [], allElements = document.getElementsByTagName('*');
     for (var i = 0; i < allElements.length; i++) {
         if (allElements[i].className == n) {
             classElements[classElements.length] = allElements[i];
         }
     }
     return classElements[0];
 }


//��ʾ���Ŵ���С
function ShowZoom(map) {
    map.enableContinuousZoom(); //�Ŵ���С��ʽ
    map.enableScrollWheelZoom(true);     //��������������
    map.enableScrollWheelZoom(); //���ù��ַŴ���С
}
////��ͼ��С�Ŵ��¼�
function ZoomEvent(map, callFun) {
    map.addEventListener('zoomend', function (e) {
        callFun(e);
    });
}
//�õ���ͼ���ż���
function getZoom(map) {
    return map.getZoom();
}
//�õ���ͼ���ĵ�
function getCenter(map) {
    var ct = map.getCenter();
    return ct.lng + "," + ct.lat;
}

//�������ż�������ĵ�
function resetZoomAndCenter(map, zoom, lng, lat) {
    map.setZoom(zoom);
    map.setCenter(new BMap.Point(lng, lat));
}


//��ӱ�ע��  lng,lat=��γ������ ico=��ע��ʾ��ͼƬ icoWidth=��עͼƬ��� icoHeight=��עͼƬ�ĸ߶�  text=��ʾ����ʾ�ı���borderColor=�ı��߿����ɫ fontColor=�ı���ɫ fontSize=�����С
function SetMarker(map, lng, lat, ico, icoWidth, icoHeight, Text, borderColor, fontColor, fontSizes) {
    var point = new BMap.Point(lng, lat);
    var MarkerList = []; ///����ӵı�ע�ŵ�������ȥ
    var marker;
    if (ico != undefined && ico != "") {
        var icons = new BMap.Icon(ico, new BMap.Size(icoWidth, icoHeight));
        marker = new BMap.Marker(point, { icon: icons }); //��ʼ����ͼ���
    } else {
        marker = new BMap.Marker(point); //��ʼ����ͼ���
    }
    map.addOverlay(marker); //�������ӵ���ͼ��
    MarkerList.push(marker);
    if (Text != undefined && Text != "") {
        var opts = {
            position: point,    // ָ���ı���ע���ڵĵ���λ��
            offset: new BMap.Size(10, -30)    //�����ı�ƫ����
        }
        var label = new BMap.Label("&nbsp;" + Text + "&nbsp;", opts);  // �����ı���ע����
        label.setStyle({
            color: fontColor,
            border: "1px solid " + borderColor,
            fontSize: fontSizes + "px",
            height: "20px",
            lineHeight: "20px",
            fontFamily: "΢���ź�"
        });
        map.addOverlay(label);
        MarkerList.push(label);
    }
    return MarkerList;
}

var infoWins = null;
//���������������  content=��ʾ������  marker=��ע����  Style=��ʽ
function addClickHandler(map, content, marker, Style) {
    var infoWin = new BMapLib.InfoBox(map, content, Style);
    marker.addEventListener("click", function (e) {
        var p = e.target;
        var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
        if (infoWins != null) { infoWins.close(); } //���ϴ˴������ÿ��ֻ������һ����
        infoWins = infoWin;
        infoWin.open(point);
    }
		);
    infoWin.addEventListener("close", function (e) {
        infoWins = null;
    });
}

///����������
function Drawing(map,drawingStyle,callFun) {
    //ʵ���������ƹ���
    var drawingManager = new BMapLib.DrawingManager(map, drawingStyle);
    //��������ƹ��߼����¼������ڻ�ȡ���ƽ��
    drawingManager.addEventListener('overlaycomplete', callFun);
    return drawingManager;
}

///������ͼ  isLoad=true���� falseȡ������
function LockMap(map,isLoad)
{
    if(isLoad){
       map.disableDragging();
    }else{
      map.enableDragging();
    }
}



/*
 �ȸ���Ƭͼת��
*/
var baiduX = new Array(0, 0, 1, 3, 6, 12, 24, 49, 98, 197, 395, 790, 1581, 3163, 6327, 12654, 25308, 50617);
var baiduY = new Array(0, 0, 0, 1, 2, 4, 9, 18, 36, 73, 147, 294, 589, 1178, 2356, 4712, 9425, 18851);
var googleX = new Array(0, 1, 3, 7, 13, 26, 52, 106, 212, 425, 851, 1702, 3405, 6811, 13623, 27246, 54492, 107917);
var googleY = new Array(0, 0, 1, 2, 5, 12, 23, 47, 95, 190, 380, 761, 1522, 3045, 6091, 12183, 24366, 47261);

/*
  �ȸ��ͼ��Ƭͼת��
*/
function toGoogleX(x, z) {
    var b = baiduX[z - 1]; //395
    var g = googleX[z - 1]; //11:843,12:1685
    var gx = g + (x - b); //   --- 1587+
    //�ȸ���Ƭ�б��=[�ȸ������Ƭ�б��+(�ٶ��б�� �C �ٶȲ�����Ƭ�б��)]
    return gx;
}
function toGoogleY(y, z) {
    var b = baiduY[z - 1]; //147
    var g = googleY[z - 1]; //10:
    var gy = g - (y - b); //
    //�ȸ���Ƭ�б��=[�ȸ������Ƭ�б��- (�ٶ��б�� �C �ٶȲ�����Ƭ�б��)] //���ϣ���Ϊ�ݼ�
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
