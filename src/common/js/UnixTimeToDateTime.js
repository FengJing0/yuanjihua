export function UnixTimeToDateTime(time){
    let now = new Date();
    let oldTime = new Date(parseInt(time)*1000);
    let UnixTime = new Date(Math.abs(now-oldTime)).getTime();
    if(UnixTime/(24*60*60*1000*365*100)>1){
        return Math.floor(UnixTime/(100*365*24*60*60*1000))+'个世纪前';
    }
    if(UnixTime/(24*60*60*1000*365)>1){
        return Math.floor(UnixTime/(365*24*60*60*1000))+'年前';
    }
    if(UnixTime/(24*60*60*1000*30)>1){
        return Math.floor(UnixTime/(30*24*60*60*1000))+'个月前';
    }
    if(UnixTime/(24*60*60*1000)>1){
        return Math.floor(UnixTime/(24*60*60*1000))+'天前';
    }
    if(UnixTime/(60*60*1000)>1){
        return Math.floor(UnixTime/(60*60*1000))+'小时前';
    }
    return Math.floor(UnixTime/1000/60)+'分钟前';
}

export function UnixTimeToTime(time1){
    var time = new Date(parseInt(time1));
      var y = time.getFullYear();
      var m = time.getMonth()+1;
      var d = time.getDate();  
      var h = time.getHours();
      var mm = time.getMinutes();
      var s = time.getSeconds();
    return y+'-'+add0(m)+'-'+add0(d)+' '+add0(h)+':'+add0(mm)+':'+add0(s);
}

function add0(m){return m<10?'0'+m:m }
