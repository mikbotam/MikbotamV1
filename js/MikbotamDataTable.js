//=====================================================START====================//

/*
 *  Base Code  	: BangAchil
 *  Email     		: kesumaerlangga@gmail.com
 *  Telegram  		: @bangachil
 *
 *  Name      		: Mikrotik bot telegram - php
 *  Function   	: Mikortik api 
 *  Manufacture	: November 2018
 *  Last Edited	: 26 Desember 2019
 *
 *  Please do not change this code
 *  All damage caused by editing we will not be responsible please think carefully,
 *
*/

//=====================================================START SCRIPT====================//
$(document).ready(function() {
	function formatCurrency(num) {

        num = num.toString().replace(/\Rp|/g,'');
        if(isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num*100+0.50000000001);
        cents = num%100;
        num = Math.floor(num/100).toString();
        if(cents<10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
            num = num.substring(0,num.length-(4*i+3))+'.'+
            num.substring(num.length-(4*i+3));
        return ((sign)?'':'-') + 'Rp ' + num + ',' + cents;

    }

  
	function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });

    return vars;
}

	function getBase64FromImageUrl(url) {
    var img = new Image();
		img.crossOrigin = "anonymous";
    img.onload = function () {
        var canvas = document.createElement("canvas");
        canvas.width =this.width;
        canvas.height =this.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(this, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    };
    img.src = url;
	}
	
	
function formatDate(date) {
  var monthNames = [
    "Januari", "Februari", "Maret",
    "April", "Mei", "juni", "Juli",
    "Augustus", "September", "Oktober",
    "November", "Desember"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

$(".dataTables_scrollHeadInner").css({"width":"100%"});

$(".table ").css({"width":"100%"});

var _0xe719=["\x42\x66\x72\x74\x69\x70","\x53\x65\x61\x72\x63\x68\x2E\x2E\x2E","","\x5F\x4D\x45\x4E\x55\x5F\x20\x69\x74\x65\x6D\x73\x2F\x70\x61\x67\x65","\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x20\x66\x61\x2D\x66\x69\x6C\x65\x2D\x70\x64\x66\x2D\x6F\x22\x3E\x3C\x2F\x69\x3E","\x70\x64\x66\x48\x74\x6D\x6C\x35","\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20","\x70\x6F\x72\x74\x72\x61\x69\x74","\x41\x34","\x3A\x76\x69\x73\x69\x62\x6C\x65","\x61\x70\x70\x6C\x69\x65\x64","\x66\x69\x6C\x6C\x43\x6F\x6C\x6F\x72","\x23\x30\x30\x38\x30\x38\x30","\x66\x6F\x72\x45\x61\x63\x68","\x62\x6F\x64\x79","\x74\x61\x62\x6C\x65","\x63\x6F\x6E\x74\x65\x6E\x74","\x73\x70\x6C\x69\x63\x65","\x67\x65\x74\x44\x61\x74\x65","\x2D","\x67\x65\x74\x4D\x6F\x6E\x74\x68","\x67\x65\x74\x46\x75\x6C\x6C\x59\x65\x61\x72","\x70\x61\x67\x65\x4D\x61\x72\x67\x69\x6E\x73","\x66\x6F\x6E\x74\x53\x69\x7A\x65","\x64\x65\x66\x61\x75\x6C\x74\x53\x74\x79\x6C\x65","\x74\x61\x62\x6C\x65\x48\x65\x61\x64\x65\x72","\x73\x74\x79\x6C\x65\x73","\x68\x65\x61\x64\x65\x72","\x6D\x69\x64\x64\x6C\x65","\x4C\x41\x50\x4F\x52\x41\x4E\x20\x41\x4B\x48\x49\x52\x20","\x66\x6F\x6F\x74\x65\x72","\x6C\x65\x66\x74","\x45\x78\x70\x6F\x72\x74\x20\x77\x69\x74\x68\x20\x6D\x69\x6B\x62\x6F\x74\x61\x6D\x20\x41\x70\x70","\x70\x61\x67\x65\x20","\x20\x6F\x66\x20","\x68\x4C\x69\x6E\x65\x57\x69\x64\x74\x68","\x76\x4C\x69\x6E\x65\x57\x69\x64\x74\x68","\x68\x4C\x69\x6E\x65\x43\x6F\x6C\x6F\x72","\x23\x61\x61\x61","\x76\x4C\x69\x6E\x65\x43\x6F\x6C\x6F\x72","\x70\x61\x64\x64\x69\x6E\x67\x4C\x65\x66\x74","\x70\x61\x64\x64\x69\x6E\x67\x52\x69\x67\x68\x74","\x6C\x61\x79\x6F\x75\x74","\x65\x78\x63\x65\x6C","\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x20\x66\x61\x2D\x66\x69\x6C\x65\x2D\x65\x78\x63\x65\x6C\x2D\x6F\x22\x3E\x3C\x2F\x69\x3E","\x4C\x61\x70\x6F\x72\x61\x6E\x20\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20","\x63\x73\x76","\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x20\x66\x61\x2D\x64\x61\x74\x61\x62\x61\x73\x65\x22\x3E\x3C\x2F\x69\x3E","\x4C\x61\x70\x6F\x72\x61\x6E\x20\x4D\x69\x6B\x62\x6F\x74\x61\x6D\x20\x20","\x70\x72\x69\x6E\x74","\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x20\x66\x61\x2D\x70\x72\x69\x6E\x74\x22\x3E\x3C\x2F\x69\x3E","\x50\x6F\x72\x74\x72\x61\x69\x74","\x70","\x23\x75\x73\x65\x72\x68\x69\x73\x74\x6F\x72\x79","\x61\x70\x69","\x73\x74\x72\x69\x6E\x67","\x72\x65\x70\x6C\x61\x63\x65","\x6E\x75\x6D\x62\x65\x72","\x72\x65\x64\x75\x63\x65","\x64\x61\x74\x61","\x63\x6F\x6C\x75\x6D\x6E","\x54\x6F\x74\x61\x6C","\x68\x74\x6D\x6C","\x45\x78\x70\x6F\x72\x74\x20\x50\x44\x46","\x69\x64","\x49\x44\x20\x43\x6F\x75\x6E\x74\x65\x72\x20\x3A\x20","\x0A\x54\x61\x6E\x67\x67\x61\x6C\x20\x20\x20\x3A\x20","\x20","\x23\x75\x73\x65\x72\x72\x65\x70\x6F\x72\x74","\x66\x61\x73\x74","\x66\x61\x64\x65\x49\x6E","\x2E\x2E\x2F\x47\x72\x61\x70\x68\x2F\x47\x65\x74\x61\x63\x74\x69\x76\x65\x2E\x70\x68\x70\x3F\x4F\x6E\x6C\x69\x6E\x65","\x6C\x6F\x61\x64","\x2E\x75\x73\x65\x72\x2D\x6F\x6E\x6C\x69\x6E\x65","\x2E\x2E\x2F\x47\x72\x61\x70\x68\x2F\x47\x65\x74\x61\x63\x74\x69\x76\x65\x2E\x70\x68\x70\x3F\x63\x70\x75","\x2E\x63\x70\x75\x2D\x6C\x6F\x61\x64","\x2E\x2E\x2F\x47\x72\x61\x70\x68\x2F\x47\x65\x74\x61\x63\x74\x69\x76\x65\x2E\x70\x68\x70\x3F\x66\x72\x65\x65\x2D\x6D\x65\x6D\x6F\x72\x79","\x2E\x66\x72\x65\x65\x2D\x6D\x65\x6D\x6F\x72\x79","\x2E\x2E\x2F\x47\x72\x61\x70\x68\x2F\x47\x65\x74\x61\x63\x74\x69\x76\x65\x2E\x70\x68\x70\x3F\x75\x70\x74\x69\x6D\x65","\x2E\x75\x70\x2D\x74\x69\x6D\x65","\x2E\x2E\x2F\x47\x72\x61\x70\x68\x2F\x47\x65\x74\x61\x63\x74\x69\x76\x65\x2E\x70\x68\x70\x3F\x61\x70\x6F\x6E\x6C\x69\x6E\x65","\x2E\x61\x70\x2D\x6F\x6E\x6C\x69\x6E\x65","\x2E\x2E\x2F\x47\x72\x61\x70\x68\x2F\x4C\x69\x76\x65\x70\x69\x6E\x67\x2E\x70\x68\x70","\x65\x72\x72\x6F\x72","\x3C\x63\x65\x6E\x74\x65\x72\x3E\x3C\x68\x31\x3E\x50\x6C\x75\x67\x69\x6E\x20\x6E\x6F\x74\x20\x6C\x6F\x61\x64\x65\x64\x3C\x2F\x68\x31\x3E\x3C\x62\x72\x3E\x44\x6F\x77\x6E\x6C\x6F\x61\x64\x20\x50\x6C\x75\x67\x69\x6E\x20\x66\x6F\x72\x20\x74\x6F\x6F\x6C\x20\x70\x69\x6E\x67\x20\x4C\x69\x76\x65\x20\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x23\x6C\x69\x76\x65"];var _0xa5d8=[_0xe719[0],_0xe719[1],_0xe719[2],_0xe719[3],_0xe719[4],_0xe719[5],_0xe719[6],_0xe719[7],_0xe719[8],_0xe719[9],_0xe719[10],_0xe719[11],_0xe719[12],_0xe719[13],_0xe719[14],_0xe719[15],_0xe719[16],_0xe719[17],_0xe719[18],_0xe719[19],_0xe719[20],_0xe719[21],_0xe719[22],_0xe719[23],_0xe719[24],_0xe719[25],_0xe719[26],_0xe719[27],_0xe719[28],_0xe719[29],_0xe719[30],_0xe719[31],_0xe719[32],_0xe719[33],_0xe719[34],_0xe719[35],_0xe719[36],_0xe719[37],_0xe719[38],_0xe719[39],_0xe719[40],_0xe719[41],_0xe719[42],_0xe719[43],_0xe719[44],_0xe719[45],_0xe719[46],_0xe719[47],_0xe719[48],_0xe719[49],_0xe719[50],_0xe719[51],_0xe719[52],_0xe719[53]];$(_0xa5d8[53]).DataTable({"\x64\x6F\x6D":_0xa5d8[0],"\x6F\x72\x64\x65\x72\x69\x6E\x67":false,"\x69\x6E\x66\x6F":false,"\x73\x63\x72\x6F\x6C\x6C\x58":true,"\x73\x63\x72\x6F\x6C\x6C\x59":350,"\x6C\x61\x6E\x67\x75\x61\x67\x65":{searchPlaceholder:_0xa5d8[1],sSearch:_0xa5d8[2],lengthMenu:_0xa5d8[3]},"\x70\x61\x67\x69\x6E\x67":false,"\x61\x75\x74\x6F\x57\x69\x64\x74\x68":true,"\x62\x75\x74\x74\x6F\x6E\x73":[{text:_0xa5d8[4],extend:_0xa5d8[5],filename:_0xa5d8[6]+ formatDate( new Date()),orientation:_0xa5d8[7],pageSize:_0xa5d8[8],exportOptions:{columns:_0xa5d8[9],search:_0xa5d8[10],order:_0xa5d8[10]},customize:function(_0x1d25x2){_0x1d25x2[_0xa5d8[16]][1][_0xa5d8[15]][_0xa5d8[14]][0][_0xa5d8[13]](function(_0x1d25x3){_0x1d25x3[_0xa5d8[11]]= _0xa5d8[12]});_0x1d25x2[_0xa5d8[16]][_0xa5d8[17]](0,1);var _0x1d25x4= new Date();var _0x1d25x5=_0x1d25x4[_0xa5d8[18]]()+ _0xa5d8[19]+ (_0x1d25x4[_0xa5d8[20]]()+ 1)+ _0xa5d8[19]+ _0x1d25x4[_0xa5d8[21]]();_0x1d25x2[_0xa5d8[22]]= [70,50,50,50];_0x1d25x2[_0xa5d8[24]][_0xa5d8[23]]= 9;_0x1d25x2[_0xa5d8[26]][_0xa5d8[25]][_0xa5d8[23]]= 10;_0x1d25x2[_0xa5d8[27]]= (function(){return {columns:[{alignment:_0xa5d8[28],text:_0xa5d8[29],margin:[180,0,0],fontSize:20,bold:true}],margin:20}});_0x1d25x2[_0xa5d8[30]]= (function(_0x1d25x6,_0x1d25x7){return {columns:[{alignment:_0xa5d8[31],text:_0xa5d8[32],margin:[40,0]},{alignment:_0xa5d8[28],text:[_0xa5d8[33],{text:_0x1d25x6.toString()},_0xa5d8[34],{text:_0x1d25x7.toString()}],margin:[-40,15]}],margin:20}});var _0x1d25x8={};_0x1d25x8[_0xa5d8[35]]= function(_0x1d25x9){return 0.5};_0x1d25x8[_0xa5d8[36]]= function(_0x1d25x9){return 0.5};_0x1d25x8[_0xa5d8[37]]= function(_0x1d25x9){return _0xa5d8[38]};_0x1d25x8[_0xa5d8[39]]= function(_0x1d25x9){return _0xa5d8[38]};_0x1d25x8[_0xa5d8[40]]= function(_0x1d25x9){return 5};_0x1d25x8[_0xa5d8[41]]= function(_0x1d25x9){return 5};_0x1d25x2[_0xa5d8[16]][0][_0xa5d8[42]]= _0x1d25x8}},{extend:_0xa5d8[43],text:_0xa5d8[44],title:_0xa5d8[45]+ formatDate( new Date()),filename:formatDate( new Date())},{extend:_0xa5d8[46],text:_0xa5d8[47],filename:_0xa5d8[48]+ formatDate( new Date())},{extend:_0xa5d8[49],text:_0xa5d8[50],orientation:_0xa5d8[51],pageSize:_0xa5d8[8],key:{key:_0xa5d8[52],altkey:true}}]});var _0xfffc=[_0xe719[0],_0xe719[1],_0xe719[2],_0xe719[3],_0xe719[54],_0xe719[55],_0xe719[56],_0xe719[57],_0xe719[58],_0xe719[59],_0xe719[60],_0xe719[61],_0xe719[62],_0xe719[30],_0xe719[63],_0xe719[5],_0xe719[6],_0xe719[64],_0xe719[7],_0xe719[8],_0xe719[9],_0xe719[10],_0xe719[11],_0xe719[12],_0xe719[13],_0xe719[14],_0xe719[15],_0xe719[16],_0xe719[17],_0xe719[22],_0xe719[23],_0xe719[24],_0xe719[25],_0xe719[26],_0xe719[27],_0xe719[31],_0xe719[65],_0xe719[66],_0xe719[28],_0xe719[29],_0xe719[32],_0xe719[33],_0xe719[34],_0xe719[35],_0xe719[36],_0xe719[37],_0xe719[38],_0xe719[39],_0xe719[40],_0xe719[41],_0xe719[42],_0xe719[43],_0xe719[45],_0xe719[67],_0xe719[46],_0xe719[48],_0xe719[49],_0xe719[51],_0xe719[52],_0xe719[68]];$(_0xfffc[59]).DataTable({"\x64\x6F\x6D":_0xfffc[0],"\x6F\x72\x64\x65\x72\x69\x6E\x67":false,"\x69\x6E\x66\x6F":false,"\x73\x63\x72\x6F\x6C\x6C\x58":true,"\x73\x63\x72\x6F\x6C\x6C\x59":350,"\x6C\x61\x6E\x67\x75\x61\x67\x65":{searchPlaceholder:_0xfffc[1],sSearch:_0xfffc[2],lengthMenu:_0xfffc[3]},"\x70\x61\x67\x69\x6E\x67":false,"\x61\x75\x74\x6F\x57\x69\x64\x74\x68":true,"\x66\x6F\x6F\x74\x65\x72\x43\x61\x6C\x6C\x62\x61\x63\x6B":function(_0x1d25xb,_0x1d25xc,_0x1d25xd,_0x1d25xe,_0x1d25xf){var _0x1d25x10=this[_0xfffc[4]](),_0x1d25xc;var _0x1d25x11=function(_0x1d25x12){return  typeof _0x1d25x12=== _0xfffc[5]?_0x1d25x12[_0xfffc[6]](/[\.,]/g,_0xfffc[2])* 1: typeof _0x1d25x12=== _0xfffc[7]?_0x1d25x12:0};var _0x1d25x13=_0x1d25x10[_0xfffc[10]](6)[_0xfffc[9]]()[_0xfffc[8]](function(_0x1d25x14,_0x1d25x15){return _0x1d25x11(_0x1d25x14)+ _0x1d25x11(_0x1d25x15)},0);$(_0x1d25x10[_0xfffc[10]](5)[_0xfffc[13]]())[_0xfffc[12]](_0xfffc[11]);$(_0x1d25x10[_0xfffc[10]](6)[_0xfffc[13]]())[_0xfffc[12]](formatCurrency(_0x1d25x13))},"\x70\x72\x6F\x63\x65\x73\x73\x69\x6E\x67":true,"\x62\x75\x74\x74\x6F\x6E\x73":[{text:_0xfffc[14],dom:_0xfffc[0],extend:_0xfffc[15],filename:_0xfffc[16]+ getUrlVars()[_0xfffc[17]]+ formatDate( new Date()),orientation:_0xfffc[18],footer:true,pageSize:_0xfffc[19],exportOptions:{columns:_0xfffc[20],search:_0xfffc[21],order:_0xfffc[21]},customize:function(_0x1d25x16){_0x1d25x16[_0xfffc[27]][1][_0xfffc[26]][_0xfffc[25]][0][_0xfffc[24]](function(_0x1d25x17){_0x1d25x17[_0xfffc[22]]= _0xfffc[23]});var _0x1d25x18=getUrlVars()[_0xfffc[17]];_0x1d25x16[_0xfffc[27]][_0xfffc[28]](0,1);var _0x1d25x19= new Date();_0x1d25x16[_0xfffc[29]]= [50,70,50,50];_0x1d25x16[_0xfffc[31]][_0xfffc[30]]= 9;_0x1d25x16[_0xfffc[33]][_0xfffc[32]][_0xfffc[30]]= 10;_0x1d25x16[_0xfffc[34]]= (function(){return {columns:[{alignment:_0xfffc[35],text:_0xfffc[36]+ _0x1d25x18+ _0xfffc[37]+ formatDate( new Date()),margin:[40,30],fillColor:_0xfffc[23],color:_0xfffc[23],bold:true},{alignment:_0xfffc[38],text:_0xfffc[39],fontSize:20,bold:true,margin:[-60,10,0]}],margin:10}});_0x1d25x16[_0xfffc[13]]= (function(_0x1d25x1a,_0x1d25x1b){return {columns:[{alignment:_0xfffc[35],text:_0xfffc[40],margin:[40,0]},{alignment:_0xfffc[38],text:[_0xfffc[41],{text:_0x1d25x1a.toString()},_0xfffc[42],{text:_0x1d25x1b.toString()}],margin:[-40,15]}],margin:10}});var _0x1d25x1c={};_0x1d25x1c[_0xfffc[43]]= function(_0x1d25x12){return 0.5};_0x1d25x1c[_0xfffc[44]]= function(_0x1d25x12){return 0.5};_0x1d25x1c[_0xfffc[45]]= function(_0x1d25x12){return _0xfffc[46]};_0x1d25x1c[_0xfffc[47]]= function(_0x1d25x12){return _0xfffc[46]};_0x1d25x1c[_0xfffc[48]]= function(_0x1d25x12){return 4};_0x1d25x1c[_0xfffc[49]]= function(_0x1d25x12){return 4};_0x1d25x16[_0xfffc[27]][0][_0xfffc[50]]= _0x1d25x1c}},{extend:_0xfffc[51],title:_0xfffc[52]+ formatDate( new Date())+ _0xfffc[53]+ getUrlVars()[_0xfffc[17]],filename:formatDate( new Date())+ _0xfffc[53]+ getUrlVars()[_0xfffc[17]]},{extend:_0xfffc[54],filename:_0xfffc[55]+ formatDate( new Date())},{extend:_0xfffc[56],orientation:_0xfffc[57],pageSize:_0xfffc[19],key:{key:_0xfffc[58],altkey:true}}]});var _0xfd19=[_0xe719[69],_0xe719[70],_0xe719[71],_0xe719[72],_0xe719[73],_0xe719[74],_0xe719[75],_0xe719[76],_0xe719[77],_0xe719[78],_0xe719[79],_0xe719[80],_0xe719[81],_0xe719[82],_0xe719[83],_0xe719[84],_0xe719[62],_0xe719[85]];var timer;var auto_refresh=setInterval(function(){$(_0xfd19[4])[_0xfd19[3]](_0xfd19[2])[_0xfd19[1]](_0xfd19[0]);$(_0xfd19[6])[_0xfd19[3]](_0xfd19[5])[_0xfd19[1]](_0xfd19[0]);$(_0xfd19[8])[_0xfd19[3]](_0xfd19[7])[_0xfd19[1]](_0xfd19[0]);$(_0xfd19[10])[_0xfd19[3]](_0xfd19[9])[_0xfd19[1]](_0xfd19[0]);$(_0xfd19[12])[_0xfd19[3]](_0xfd19[11])[_0xfd19[1]](_0xfd19[0]);$(_0xfd19[17])[_0xfd19[3]](_0xfd19[13],function(_0x1d25x20,_0x1d25x21,_0x1d25x22){if(_0x1d25x21== _0xfd19[14]){$(_0xfd19[17])[_0xfd19[16]](_0xfd19[15])}})[_0xfd19[1]](_0xfd19[0])},5000)
});