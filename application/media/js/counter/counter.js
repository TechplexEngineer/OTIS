function getObject(objId) {
	if (document.getElementById)
		return document.getElementById(objId);
	else if (document.layers)
		return eval("document." + objId);
	else if (document.all)
		return eval("document.all." + objId);
	else
		return eval("document." + objId);
}

function write(str, div){
	objCnt=getObject(div);
	if (objCnt) {
		if(bName == "Netscape")
			objCnt.textContent=str;
		else
			objCnt.innerText=str;
	}
}

function charCount(objId){
	return getObject(objId).value.length;
}

var outputId = 'msg';
var inputId  = 'MessageText';
var inputId2 = 'smsto';
var minChars = 15;
var maxChars = 120;
var sendId   = 'send';
var bName = navigator.appName;
//crude hack
var count  = 4;//charCount(inputId);
//divName, taId, min, max
// onKeyUp

//outputId, inputId, minChars, maxChars, sendId
//'msg', 'MessageText', 15, 120, 'send'

function updateCount()
{

	count = charCount(inputId);

	if(count == 0)
		write("Enter at least " +minChars+ " characters", outputId);
	if(count > 0 && count < minChars)
		write((minChars-count)+ " more to go...", outputId);
	if(count >= minChars)
		write((maxChars - count)+ " chararacters left", outputId);


	//Limit the textfield's length
	//objVal=getObject(inputId).value;
	//if (count>maxChars)
	//	objVal=objVal.substring(0,maxL);

	// Disable the send button when too many characters are entered
	checkEnable();
}

function checkEnable()
{
	count = charCount(inputId);
	if(count < minChars || count > maxChars)
	{
		//disable send button
		getObject(sendId).disabled=true;
		console.log("disable");
	}
	else
	{
		if(charCount(inputId2) > 2)
		{
			//enable send button
			write("", 'tomsg');
			getObject('send').disabled=false;
			console.log("enable");
		}
		else
		{
			write("You need to specify at least one recipient", 'tomsg');
			getObject(sendId).disabled=true;
			console.log("disable");
		}
	}
}

/*function min(outputId, inputId, minChars,  sendId)
{
	var count = charCount(inputId);

	if(count == 0)
		write("Enter at least " +minChars+ " characters", outputId);
	/*if(count > 0 && count < minChars)
		write((minChars-count)+ " more to go...", outputId);
	if(count >= minChars)
		write((maxChars - count)+ " chararacters left", outputId);*


	// Disable the send button when too many characters are entered
	if(count < minChars)
	{
		//disable send button
		getObject(sendId).disabled=true;
		console.log("disable");
	}
	else
	{
		//enable send button
		getObject(sendId).disabled=false;
		console.log("enable");
	}
}*/