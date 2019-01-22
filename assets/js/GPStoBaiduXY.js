/**********************************************************
本文件主要用于GPS坐标转换百度坐标，请配合map使用(转换请输入实际获取的设备GPS坐标)
可根据百度在线测试的效果对比，0误差
本转换规则是 GPS坐标转谷歌坐标（公开函数）谷歌坐标转百度坐标（公开函数）
通过互转直接达到GPS转百度的效果
创建于：2016-06-07 
作者：YTW
*/

 var pi = 3.14159265358979324;  
 var a = 6378245.0;  
 var ee = 0.00669342162296594323;
 var x_pi = 3.14159265358979324 * 3000.0 / 180.0; 

 function outOfChina(lat,lon)  
    {  
        if (lon < 72.004 || lon > 137.8347)  
            return true;  
        if (lat < 0.8293 || lat > 55.8271)  
            return true;  
        return false;
    }


    function transformLat(x, y) {

        var ret = -100.0 + 2.0 * x + 3.0 * y + 0.2 * y * y + 0.1 * x * y + 0.2 * Math.sqrt(Math.abs(x));
        ret += (20.0 * Math.sin(6.0 * x * pi) + 20.0 * Math.sin(2.0 * x * pi)) * 2.0 / 3.0;
        ret += (20.0 * Math.sin(y * pi) + 40.0 * Math.sin(y / 3.0 * pi)) * 2.0 / 3.0;
        ret += (160.0 * Math.sin(y / 12.0 * pi) + 320 * Math.sin(y * pi / 30.0)) * 2.0 / 3.0;  
        return ret;  
    }  
 
     function transformLon( x,  y)  
    {
        var ret = 300.0 + x + 2.0 * y + 0.1 * x * x + 0.1 * x * y + 0.1 * Math.sqrt(Math.abs(x));
        ret += (20.0 * Math.sin(6.0 * x * pi) + 20.0 * Math.sin(2.0 * x * pi)) * 2.0 / 3.0;
        ret += (20.0 * Math.sin(x * pi) + 40.0 * Math.sin(x / 3.0 * pi)) * 2.0 / 3.0;
        ret += (150.0 * Math.sin(x / 12.0 * pi) + 300.0 * Math.sin(x / 30.0 * pi)) * 2.0 / 3.0;  
        return ret;  
    }  


     /**
     * 地球坐标转换为火星坐标（GPS》谷歌）
     * World Geodetic System ==> Mars Geodetic System
     *
     * @param wgLat  地球坐标
     * @param wgLon
     *
     * mglat,mglon 火星坐标
     */  
     function transform2Mars( wgLat, wgLon)  
    {  
        if (outOfChina(wgLat, wgLon))  
        {  
            var mgLat  = wgLat;  
            var mgLon = wgLon;  
            var Points={lat:mgLat,lon:mgLon};
            return Points;  
        }  
        var dLat = transformLat(wgLon - 105.0, wgLat - 35.0);  
        var dLon = transformLon(wgLon - 105.0, wgLat - 35.0);  
        var radLat = wgLat / 180.0 * pi;  
        var magic = Math.sin(radLat);  
        magic = 1 - ee * magic * magic;  
        var sqrtMagic = Math.sqrt(magic);  
        dLat = (dLat * 180.0) / ((a * (1 - ee)) / (magic * sqrtMagic) * pi);  
        dLon = (dLon * 180.0) / (a / sqrtMagic * Math.cos(radLat) * pi);  
        
        var mgLat = wgLat + dLat;  
        var mgLon = wgLon + dLon;  
        var Points={lat:mgLat,lon:mgLon};
        return Points;
    }  
 
    /**
     * 火星（谷歌）坐标转换为百度坐标
     * @param gg_lat
     * @param gg_lon
     */  
     function bd_encrypt(gg_lat, gg_lon)  
    {  
        var x = gg_lon, y = gg_lat;  
        var z = Math.sqrt(x * x + y * y) + 0.00002 * Math.sin(y * x_pi);  
        var theta = Math.atan2(y, x) + 0.000003 * Math.cos(x * x_pi);  
        var bd_lon = z * Math.cos(theta) + 0.0065;  
        var bd_lat = z * Math.sin(theta) + 0.006;  
        var Points={lat:bd_lat,lon:bd_lon};
        return Points;
    }  
 
    /**
     * 百度转火星（谷歌）
     * @param bd_lat
     * @param bd_lon
     */  
     function bd_decrypt( bd_lat,  bd_lon)  
    {  
        var x = bd_lon - 0.0065, y = bd_lat - 0.006;
        var z = Math.sqrt(x * x + y * y) - 0.00002 * Math.sin(y * x_pi);
        var theta = Math.atan2(y, x) - 0.000003 * Math.cos(x * x_pi);
        gg_lon = z * Math.cos(theta);
        gg_lat = z * Math.sin(theta);
        var Points = { lat: gg_lat, lon: gg_lon };
        return Points;
    }


    /*
    *GPS坐标转换经纬度坐标的调用函数
    *@param pointData 需要转换的经纬度坐标一个object对象[{jingdu: 99.16085718, weidu: 25.11510914},{jingdu: 99.16085718, weidu: 25.11510914}]
    *return 返回一个相同的对象
    */
    function GPSGetPoint(pointData) {
        var BaiDuPointList = []; ///转换后的百度坐标
        for (var i = 0; i < pointData.length; i++) {
            var lat = parseFloat(pointData[i].weidu);
            var lon = parseFloat(pointData[i].jingdu);
            var point = transform2Mars(lat, lon);
            var points = bd_encrypt(point.lat, point.lon);
            BaiDuPointList.push({ jingdu: points.lon, weidu: points.lat });
        }
        return BaiDuPointList;
    }