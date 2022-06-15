<?php
namespace app\common\model;

use think\Model;

class Executiveflight extends Model{

    public function search($data){
        //验证
        $validate = new \app\common\validate\Executiveflight();
        if($validate->scene('search')->check($data)==0){
            return $validate->getError();
        }

        //查询
        $res = model('Executiveflight')->query("
            select m.execId,m.shippingId,m.salePrice,m.discount,m.remains,m.isMeal,p.shippingGrade grade from
            (select a.execId,a.execDate,a.execPrice,a.status,a.estimateDeparture,a.estimateArrival,b.shippingId,b.salePrice,b.discount,b.remains,b.isMeal,
            e.airportName depart,f.cityName departCity
            from executiveflight a,tickettypes b,flight c,terminal d,airport e,city f
            where a.execId=b.execId and a.flightId=c.flightId and c.departTerminal=d.terminalId and d.airportId=e.airportId and e.cityId=f.cityId
            )m, 
            (select a.execId,a.execDate,a.execPrice,a.status,a.estimateDeparture,a.estimateArrival,b.shippingId,b.salePrice,b.discount,b.remains,b.isMeal,
            e.airportName depart,f.cityName arrivalCity
            from executiveflight a,tickettypes b,flight c,terminal d,airport e,city f
            where a.execId=b.execId and a.flightId=c.flightId and c.arrivalTerminal=d.terminalId and d.airportId=e.airportId and e.cityId=f.cityId
            )n, shipping p
            where m.execId=n.execId and m.shippingId=p.shippingId and m.shippingId=n.shippingId
            and m.departCity=?
            and n.arrivalCity=?
            and m.execDate=?;",[$data['depart'],$data['arrival'],$data['execDate']]);

        if(!$res){
            return "未查找到航班信息！";
        }

        $list = model('Executiveflight')->query("
            select DISTINCT m.execId,m.execDate,m.execPrice,m.status,m.estimateDeparture,m.estimateArrival,m.depart depart,m.deTerName,m.boardingGate,n.depart arrival,n.arTerName,m.departCity,n.arrivalCity from
            (select a.execId,a.execDate,a.execPrice,a.status,a.estimateDeparture,a.estimateArrival,a.boardingGate,b.shippingId,b.salePrice,b.discount,b.remains,b.isMeal,
            e.airportName depart,f.cityName departCity,d.terminalName deTerName
            from executiveflight a,tickettypes b,flight c,terminal d,airport e,city f
            where a.execId=b.execId and a.flightId=c.flightId and c.departTerminal=d.terminalId and d.airportId=e.airportId and e.cityId=f.cityId
            )m, 
            (select a.execId,a.execDate,a.execPrice,a.status,a.estimateDeparture,a.estimateArrival,b.shippingId,b.salePrice,b.discount,b.remains,b.isMeal,
            e.airportName depart,f.cityName arrivalCity,d.terminalName arTerName
            from executiveflight a,tickettypes b,flight c,terminal d,airport e,city f
            where a.execId=b.execId and a.flightId=c.flightId and c.arrivalTerminal=d.terminalId and d.airportId=e.airportId and e.cityId=f.cityId
            )n, shipping p
            where m.execId=n.execId and m.shippingId=p.shippingId and m.shippingId=n.shippingId
            and m.departCity=?
            and n.arrivalCity=?
            and m.execDate=?;",[$data['depart'],$data['arrival'],$data['execDate']]);

        if(!$list){
            return "未查找到航班信息！";
        }

        $i=0;$j=0;
        $grade = array();
        $result = array();
        foreach ($res as $value){
            if($j!=0 && $j%3==0){
                $i++;
                $j=0;
            }
            $grade[$i][$j]= $value;
            $j++;
        }
        $i=0;
        foreach ($list as $value){
            $result[$i] = $value;
            $result[$i]['grade'] = $grade[$i];
            $i++;
        }

        return $result;
    }

    public function infosave($data){

        return 1;
    }
}