// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;
// Maximum no of digits in an america phone no.
var maxDigitsInIPhoneNumber = 13;
//US Area Code
var AreaCode=new Array(205,251,659,256,334,907,403,780,264,268,520,928,480,602,623,501,479,870,242,246,441,250,604,778,284,341,442,628,657,669,747,752,764,951,209,559,408,831,510,213,310,424,323,562,707,369,627,530,714,949,626,909,916,760,619,858,935,818,415,925,661,805,650,600,809,345,670,211,720,970,303,719,203,475,860,959,302,411,202,767,911,239,386,689,754,941,954,561,407,727,352,904,850,786,863,305,321,813,470,478,770,678,404,706,912,229,710,473,671,808,208,312,773,630,847,708,815,224,331,464,872,217,618,309,260,317,219,765,812,563,641,515,319,712,876,620,785,913,316,270,859,606,502,225,337,985,504,318,318,204,227,240,443,667,410,301,339,351,774,781,857,978,508,617,413,231,269,989,734,517,313,810,248,278,586,679,947,906,616,320,612,763,952,218,507,651,228,601,557,573,636,660,975,314,816,417,664 ,406,402,308,775,702,506,603,551,848,862,732,908,201,973,609,856,505,575,585,845,917,516,212,646,315,518,347 ,718,607,914,631,716,709,252,336,828,910,980,984,919,704,701,283,380,567,216,614,937,330,234,440,419,740,513 ,580,918,405,905,289,647,705,807,613,519,416,503,541,971,445,610,835,878,484,717,570,412,215,267,814,724,902,787,939,438,450,819,418,514,401,306,803,843,864,605,869,758,784,731,865,931,423,615,901,325,361,430,432,469,682,737,979,214,972,254,940,713,281,832,956,817,806,903,210,830,409,936,512,915,868,649,340,385,435,801,802,276,434,540,571,757,703,804,509,206,425,253,360,564,304,262,920,414,715,608,307,867)

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}
function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}
function checkInternationalPhone(strPhone){
strPhone=trim(strPhone)
if(strPhone.indexOf("00")==0) strPhone=strPhone.substring(2)
if(strPhone.indexOf("+")>1) return false
if(strPhone.indexOf("+")==0) strPhone=strPhone.substring(1)
if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
if(strPhone.indexOf("(")!=-1 && strPhone.indexOf(")")==-1)return false
s=stripCharsInBag(strPhone,validWorldPhoneChars);
if(strPhone.length>10){var CCode=s.substring(0,s.length-10);}
else{CCode="";}
if(strPhone.length>7){var NPA=s.substring(s.length-10,s.length-7);}
else{NPA=""}
var NEC=s.substring(s.length-7,s.length-4)
if(CCode!="" && CCode!=null){
	if(CCode!="1" && CCode!="011" && CCode!="001") return false
	}
if(NPA!=""){
  if(checkAreaCode(NPA)==false){ //Checking area code is vaid or not
  	return false
	}
}
else{return false}
return (isInteger(s) && s.length >= minDigitsInIPhoneNumber  &&  s.length <= maxDigitsInIPhoneNumber );
}
//Checking area code is vaid or not
function checkAreaCode(val){
	var res=false;
	for (var i=0; i<AreaCode.length;i++){
		if(AreaCode[i]==val) res=true;
	}
	return res
}

function checkdate(input, spliter){

  //Detailed check for valid date ranges
 if(spliter == "-"){
 	input_array = input.split(spliter); 
	var yearfield=input_array[0];
	var monthfield=input_array[1];
	var dayfield=input_array[1];
 }else{
 	input_array = input.split("/");
	var monthfield=input_array[0];
	var dayfield=input_array[1];
	var yearfield=input_array[2];
 }
   

var dayobj = new Date(yearfield, monthfield-1, dayfield);
    if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
        return false  ;
    else
        return true ;
}
 
function compareDate(date1,date2){
	//date2 = new Date(date2); date1 = new Date(date1);
	date2 = new Date(date2).getTime();
    date1 = new Date(date1).getTime();
	if(date2 > date1 ) 	return true;
 	return false; 
}
 

function getWeekNumber(d) {
    // Copy date so don't modify original
    d = new Date(d);
    d.setHours(0,0,0);
    // Set to nearest Thursday: current date + 4 - current day number
    // Make Sunday's day number 7
    d.setDate(d.getDate() + 4 - (d.getDay()||7));
    // Get first day of year
    var yearStart = new Date(d.getFullYear(),0,1);
    // Calculate full weeks to nearest Thursday
    var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
    // Return array of year and week number
     return [d.getFullYear(), weekNo];
		
		//Return  week number
		//return weekNo;
}

function days_between(date1, date2) { 
  // The number of milliseconds in one day
  var ONE_DAY = 1000 * 60 * 60 * 24
	var date1 = new Date(date1);
	var date2 = new Date(date2);
  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();

  // Calculate the difference in milliseconds
  var difference_ms = Math.abs(date1_ms - date2_ms)

  // Convert back to days and return
  return Math.round(difference_ms/ONE_DAY)

}

function isFloat(value){
    var valid = (value.match(/^-?\d*(\.\d+)?$/));
    return valid;
   /*
   if(isNaN(value) || value.indexOf(".")<0){
     return false;
   } else {
      if(parseFloat(value)) {
              return true;
          } else {
              return false;
          }
   }
   */
}

function numInRange(num,start,limit){ 
	if((start <= num) && (num <= limit) ){
		return true;
	} 
	return false;
}

function isInt(value){
 if(IsNonEmpty(value)){
    var intRegex = /^\d+$/;
    if(intRegex.test(value)) {
       return true;
    }else {
      return false;
    }
  /*
  if(!isFloat(value) && !isNaN(value)){
      return true;
  } else {
      return false;
  }*/
 }
}

function is_gt_zero_num(value){
    if(IsNonEmpty(value)){
      if(isInt(value) && (value > 0)){
          return true;
      }
    }
    return false;
}

function wordwrap( str, width, brk, cut ) {

    brk = brk || '\n';
    width = width || 75;
    cut = cut || false;

    if (!str) { return str; }

    var regex = '.{1,' +width+ '}(\\s|$)' + (cut ? '|.{' +width+ '}|.+$' : '|\\S+?(\\s|$)');

    return str.match( RegExp(regex, 'g') ).join( brk );

}


    function trim(str) {
			if((str != '') && (str.length > 0)){
				  while (str.substring(0, 1) == ' ') {
	        	str = str.substring(1, str.length);
	    		}
	    		while (str.substring(str.length - 1, str.length) == ' ') {
	        str = str.substring(0, str.length - 1);
	    	} 
			} 
			return str;
    }


    function isUSZip(zipcode)
    {
		return /^\d{5}(-\d{4})?$/.test(zipcode);
    }
    
    function isIndianZip(zipcode){
     return /^([1-9])([0-9]){5}$/.test(zipcode);
    }
    
    function IsAlphaNumeric(value){
		return /^[0-9a-zA-Z\ ]+$/.test(value);
	}
	
	function IsAlphabates(value){
		return /^[a-zA-Z\ ]+$/.test(value);
	}

	function IsAlphaspecial(value){
		return /^[ \A-Za-z0-9\-\.\,\#\@\!\*\&\(\_\)\$]+$/i.test(value);
	}
    
    function IsAllowspecial(value){
		return 	/^[ \A-Za-z0-9\!\@\#\$\%\&\.\*\(\)\_\-\:\?\[\]\,]+$/i.test(value);
	}

    function IsAllowcomma(value){
		return 	/^[ \A-Za-z0-9\-\,]+$/i.test(value);
	}


	function isEmail(str)
    {

    		var at="@"
    		var dot="."
    		var lat=str.indexOf(at)
    		var lstr=str.length
    		var ldot=str.indexOf(dot)
    		if (str.indexOf(at)==-1){
    		   return false
    		}

    		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
    		   return false
    		}

    		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
    		    return false
    		}

    		 if (str.indexOf(at,(lat+1))!=-1){
    		    return false
    		 }

    		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
    		    return false
    		 }

    		 if (str.indexOf(dot,(lat+2))==-1){
    		    return false
    		 }

    		 if (str.indexOf(" ")!=-1){
    		    return false
    		 }

            //if (reason != "") {
            //    alert("Some fields need correction:\n\n" + reason);
            //    return false;
            //  }

          return true;
    }

function isPhoneNumber(str){
  //var re = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/
  //return re.test(str);
  if (checkInternationalPhone(str)==false){
    return false;
  }
  return true;
}

function isIndianPhoneNumber(str){
  var re =   /^[0-9]\d{2,4}-\d{6,8}$/
  return re.test(str);
  
}

function isIndianMobileNumber(str){
  var re =  /^(\+91?)\d{10}$/
  return re.test(str);
}



function IsNumeric(PossibleNumber)
{
	var PNum = new String(PossibleNumber);
	var regex = /[^0-9^.]/;
	return !regex.test(PNum);
}

function IsNonEmpty(value) { 
	if (value == undefined){ 
      return false;
  }else{
    if(value == 'null'){
      return false;
    }else{
        if(value){
					if(value != ''){
						var vStr = trim(value);
            if (vStr.length == 0){
                return false;
            }else{
                return true;
            }
					} 
        } 
    }
 }
  return false;
}


function formatDate(value)
{
   return value.getMonth()+1 + "/" + value.getDate() + "/" + value.getFullYear();
}

function check_alphaonly(value)
{
    re = /^[A-Za-z]+$/;
 return re.test(value) ;
}


function check_alphanumeric(value)
{
    re = /^[A-Za-z0-9]+$/;
 return re.test(value);
}

function check_alphaspecial(value){
 re = /^[A-Za-z0-9!@#$%^&*()_]$/;
   return re.test(value);
}

function check_latitude(value){
	re = /^-?([0-8]?[0-9]|90)\.[0-9]{1,6}$/;
	return re.test(value);
}
function check_longitude(value){
	re = /^-?((1?[0-7]?|[0-9]?)[0-9]|180)\.[0-9]{1,6}$/;
	return re.test(value);
}

function IsFileType(vfilename,vfiletype){
   if ((vfilename.indexOf('.' + vfiletype.toUpperCase()) == -1)
		&&(vfilename.indexOf('.' +vfiletype.toLowerCase()) == -1)){
        return false;
  }else{
        return true;
  }
}

function isUrl(value) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(value);
}


 function between(mystring, prefix, suffix) {
  s = mystring;
  var i = s.indexOf(prefix);
  if (i >= 0) {
    s = s.substring(i + prefix.length);
  }
  else {
    return '';
  }
  if (suffix) {
    i = s.indexOf(suffix);
    if (i >= 0) {
      s = s.substring(0, i);
    }
    else {
      return '';
    }
  }
  return s;
}

function array_unique(origArr) {
    var newArr = [],
        origLen = origArr.length,
        found,
        x, y;
 
    for ( x = 0; x < origLen; x++ ) {
        found = undefined;
        for ( y = 0; y < newArr.length; y++ ) {
            if ( origArr[x] === newArr[y] ) { 
              found = true;
              break;
            }
        }
        if ( !found) newArr.push( origArr[x] );    
    }
   return newArr;
}

function PopupCenter(pageURL, title,w,h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function elemById(vId){
       return document.getElementById(vId);
}
                                                
function elemByName(vName){
   return document.getElementsByName(vName)[0];
}

function elemRadioCheckedValue(radio_name){
   var oRadio = document.getElementsByName(radio_name);
   for(var i = 0; i < oRadio.length; i++){
      if(oRadio[i].checked){
				  
         return oRadio[i].value;
      }
   }
   return 1;
}  

function biz_explode(delimiter, str){
  var arr = []; 
  if(str.indexOf(delimiter) != -1){ 
    arr = str.split(delimiter);
  }else{
    arr[0] = str;
  }
  return arr;
}


function sprintf () { 
  var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g;
  var a = arguments,
    i = 0,
    format = a[i++];

  // pad()
  var pad = function (str, len, chr, leftJustify) {
    if (!chr) {
      chr = ' ';
    }
    var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
    return leftJustify ? str + padding : padding + str;
  };

  // justify()
  var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
    var diff = minWidth - value.length;
    if (diff > 0) {
      if (leftJustify || !zeroPad) {
        value = pad(value, minWidth, customPadChar, leftJustify);
      } else {
        value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
      }
    }
    return value;
  };

  // formatBaseX()
  var formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
    // Note: casts negative numbers to positive ones
    var number = value >>> 0;
    prefix = prefix && number && {
      '2': '0b',
      '8': '0',
      '16': '0x'
    }[base] || '';
    value = prefix + pad(number.toString(base), precision || 0, '0', false);
    return justify(value, prefix, leftJustify, minWidth, zeroPad);
  };

  // formatString()
  var formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
    if (precision != null) {
      value = value.slice(0, precision);
    }
    return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
  };

  // doFormat()
  var doFormat = function (substring, valueIndex, flags, minWidth, _, precision, type) {
    var number;
    var prefix;
    var method;
    var textTransform;
    var value;

    if (substring === '%%') {
      return '%';
    }

    // parse flags
    var leftJustify = false,
      positivePrefix = '',
      zeroPad = false,
      prefixBaseX = false,
      customPadChar = ' ';
    var flagsl = flags.length;
    for (var j = 0; flags && j < flagsl; j++) {
      switch (flags.charAt(j)) {
      case ' ':
        positivePrefix = ' ';
        break;
      case '+':
        positivePrefix = '+';
        break;
      case '-':
        leftJustify = true;
        break;
      case "'":
        customPadChar = flags.charAt(j + 1);
        break;
      case '0':
        zeroPad = true;
        break;
      case '#':
        prefixBaseX = true;
        break;
      }
    }

    // parameters may be null, undefined, empty-string or real valued
    // we want to ignore null, undefined and empty-string values
    if (!minWidth) {
      minWidth = 0;
    } else if (minWidth === '*') {
      minWidth = +a[i++];
    } else if (minWidth.charAt(0) == '*') {
      minWidth = +a[minWidth.slice(1, -1)];
    } else {
      minWidth = +minWidth;
    }

    // Note: undocumented perl feature:
    if (minWidth < 0) {
      minWidth = -minWidth;
      leftJustify = true;
    }

    if (!isFinite(minWidth)) {
      throw new Error('sprintf: (minimum-)width must be finite');
    }

    if (!precision) {
      precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined;
    } else if (precision === '*') {
      precision = +a[i++];
    } else if (precision.charAt(0) == '*') {
      precision = +a[precision.slice(1, -1)];
    } else {
      precision = +precision;
    }

    // grab value using valueIndex if required?
    value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

    switch (type) {
    case 's':
      return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
    case 'c':
      return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
    case 'b':
      return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'o':
      return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'x':
      return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'X':
      return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
    case 'u':
      return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'i':
    case 'd':
      number = +value || 0;
      number = Math.round(number - number % 1); // Plain Math.round doesn't just truncate
      prefix = number < 0 ? '-' : positivePrefix;
      value = prefix + pad(String(Math.abs(number)), precision, '0', false);
      return justify(value, prefix, leftJustify, minWidth, zeroPad);
    case 'e':
    case 'E':
    case 'f': // Should handle locales (as per setlocale)
    case 'F':
    case 'g':
    case 'G':
      number = +value;
      prefix = number < 0 ? '-' : positivePrefix;
      method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
      textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
      value = prefix + Math.abs(number)[method](precision);
      return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
    default:
      return substring;
    }
  };

  return format.replace(regex, doFormat);
}
