function request(){
  var xmlhttp=null;
  try{
	     xmlhttp=new XMLHttpRequest();
	  }
  catch(e){
	    try{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e){
			  try{
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  catch(e){
				  xmlhttp=null;
				  }
			}
	  }
	  
	  if( xmlhttp==null){
		  alert('nocreatXMLHTTP');
		  }
		  else{
			  return xmlhttp;
			  }
}
var xmlhttp1=request();