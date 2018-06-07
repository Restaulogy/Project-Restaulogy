function checkdate(input){

  //Detailed check for valid date ranges

  input_array = input.split("/");
var monthfield=input_array[0];
var dayfield=input_array[1];
var yearfield=input_array[2];
var dayobj = new Date(yearfield, monthfield-1, dayfield);
    if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
        return false  ;
    else
        return true ;
}

function isFloat(value){

   if(isNaN(value) || value.indexOf(".")<0){
     return false;
   } else {
      if(parseFloat(value)) {
              return true;
          } else {
              return false;
          }
   }
}


function isInt(value){
 if(IsNonEmpty(value)){
  if(!isFloat(value) && !isNaN(value)){
      return true;
  } else {
      return false;
  }
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
    while (str.substring(0, 1) == ' ') {
        str = str.substring(1, str.length);
    }
    while (str.substring(str.length - 1, str.length) == ' ') {
        str = str.substring(0, str.length - 1);
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
  var re = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/
  return re.test(str);
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
           var vStr = trim(value);
            if (vStr.length == 0){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
 }
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