function GiftCertificateForm(formId, themeImagesUrl)
{
	GiftCertificateForm.prototype.___instance=this;
	
	
	this.form=document.getElementById(formId);
	this.form.onsubmit=new Function("evt", "GiftCertificateForm.prototype.___instance.onSubmit(evt)");
	
	this.canvas=this.form.querySelectorAll("canvas")[0];
	
	
	
	//add event listeners for the elements that affect the ticket image (SELECTs and the message TEXTAREA), also the messages next to the inputs
	this.selectAmount=this.form.elements["giftTicketAmount"];
	this.selectAmount.addEventListener("change", new Function("evt", "GiftCertificateForm.prototype.___instance.onAmountChange(evt)"));	
	
	this.selectTheme=this.form.elements["giftTicketTheme"];
	this.selectTheme.addEventListener("change", new Function("evt", "GiftCertificateForm.prototype.___instance.onThemeChange(evt)"));
	
	//for the textarea there are a few events triggered when the user types in, or paste, do , undo etc
	//related to the keyboard
	this.textareaMessage=this.form.elements["giftTicketMessage"];
	for(var i=0; i<GiftCertificateForm.prototype.___textEvents.length; i++)
	{
		this.textareaMessage.addEventListener(GiftCertificateForm.prototype.___textEvents[i], new Function("evt", "GiftCertificateForm.prototype.___instance.onMessageChange(evt)"));	
	}
	
	//load/pre-cache theme backgrounds
	this.themeImages=new Array();
		
	for(var i=0; i<this.selectTheme.options.length; i++)
	{
		this.themeImages[i]=new Image();
		//this.themeImages[i].onload=GiftCertificateForm.prototype.___instance.onLoadThemeImage; // this is supposed to keep track of what theme images are loaded so they can be used
		this.themeImages[i].src=themeImagesUrl+"/GiftCertificate-"+(i+1)+".jpg"; //this should come from db or PHP array
		
	}
	
	this.previousMessage="";
	
	this.onAmountChange();
	this.onThemeChange();
}

with(GiftCertificateForm)
{
	prototype.___textEvents=["keyup", "paste", "drop"];
	prototype.___instance=null;//kind of singletone, "static" __instance keeps the uniques GiftCertificateForm instance
	
	prototype.getAmountAndCost=GiftCertificateForm_getAmountAndCost;
	
	prototype.onAmountChange=GiftCertificateForm_onAmountChange;
	prototype.onThemeChange=GiftCertificateForm_onThemeChange;
	prototype.onMessageChange=GiftCertificateForm_onMessageChange;
	
	//prototype.onLoadThemeImage=GiftCertificateForm_onLoadThemeImage;
	prototype.drawGiftCertificate=GiftCertificateForm_drawGiftCertificate;
	
	prototype.onSubmit=GiftCertificateForm_onSubmit;
}
function GiftCertificateForm_getAmountAndCost()
{
	var amt;
	if(this.selectAmount.selectedIndex==0)
	{
		return null;
	}
	amt=this.selectAmount.value.split("|");
	
	return {"amount": amt[0], "cost": amt[1]};

}
function GiftCertificateForm_onAmountChange(evt)
{
	var amt=this.getAmountAndCost();
	
	if(!amt)
	{//no amount selected, hide the amt/cost message
		this.form.ownerDocument.getElementById("ticketAmountAndCostMsg").style.display="none";
		//show no selection message
		this.form.ownerDocument.getElementById("ticketAmountAndCostNoSelectionMsg").style.display="block";
		
	}
	else
	{
		//hide no sel. msg
		this.form.ownerDocument.getElementById("ticketAmountAndCostNoSelectionMsg").style.display="none";
		//update amount/cost message
		this.form.ownerDocument.getElementById("ticketAmountAndCostMsg").style.display="block";
		this.form.ownerDocument.getElementById("ticketAmoutMsg").innerHTML="$"+amt.amount;
		this.form.ownerDocument.getElementById("ticketCostMsg").innerHTML="$"+amt.cost;
	}
	this.drawGiftCertificate();
}
function GiftCertificateForm_onThemeChange(evt)
{
	if(this.selectTheme.selectedIndex<1)
	{
		this.form.ownerDocument.getElementById("giftTicketThemeMsg").style.display="none";
		this.form.ownerDocument.getElementById("giftTicketThemeNoSelectionMsg").style.display="block";	
	}
	else
	{
		this.form.ownerDocument.getElementById("giftTicketThemeNoSelectionMsg").style.display="none";	
		this.form.ownerDocument.getElementById("giftTicketThemeMsg").style.display="block";
		this.form.ownerDocument.getElementById("giftTicketThemeNameMsg").innerHTML=this.selectTheme.options[this.selectTheme.selectedIndex].text;
		
	}
	this.drawGiftCertificate();
}
function GiftCertificateForm_onMessageChange(evt)
{
	this.drawGiftCertificate();
}
/*
function GiftCertificateForm_onLoadThemeImage(evt)
{
	console.log(evt.target.src);
	document.getElementById("testImg").src=evt.target.src;
}
*/
function GiftCertificateForm_drawGiftCertificate()
{
	if(this.selectTheme.selectedIndex<1 || this.selectAmount.selectedIndex<1)
	{
		this.canvas.style.display="none";
		return;
	}
	this.canvas.style.display="block";
	
	this.canvas.width=this.themeImages[this.selectTheme.selectedIndex-1].width;
	this.canvas.height=this.themeImages[this.selectTheme.selectedIndex-1].height;
	
	var context;
	
	context=this.canvas.getContext("2d");
	
	context.drawImage(this.themeImages[this.selectTheme.selectedIndex-1], 0, 0, 537, 321);
	
	context.font="36px Fredoka One, serif";
	context.textAlign="center";
	
	var amt=this.getAmountAndCost();
	
	amt=amt.amount.split(".")[0];
	
	context.fillText("$"+amt, this.canvas.width*0.16, this.canvas.height*0.195);
	
	context.font="13px Arial, serif";
	context.textAlign="left";
	context.fillText(this.textareaMessage.value, this.canvas.width*0.2, this.canvas.height*0.33);
	
	
	//alert(this.themeImages[this.selectTheme.selectedIndex-1].src);
}
function GiftCertificateForm_onSubmit()
{
	
	this.form.elements["imgBlob"].value=this.canvas.toDataURL("image/jpeg");
}