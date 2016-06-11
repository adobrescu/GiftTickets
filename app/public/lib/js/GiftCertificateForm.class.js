function GiftCertificateForm(formId, themeImagesUrl)
{
	GiftCertificateForm.prototype.___instance=this;
	
	
	this.form=document.getElementById(formId);
	this.canvas=this.form.querySelectorAll("canvas")[0];
	
	
	
	//add event listeners for the elements that affect the ticket image (SELECTs and the message TEXTAREA), also the messages next to the inputs
	this.selectAmount=this.form.elements["giftTicketAmount"];
	this.selectAmount.addEventListener("change", GiftCertificateForm.prototype.___instance.onAmountChange);	
	
	this.selectTheme=this.form.elements["giftTicketTheme"];
	this.selectTheme.addEventListener("change", GiftCertificateForm.prototype.___instance.onThemeChange);	
	
	//for the textarea there are a few events triggered when the user types in, or paste, do , undo etc
	//related to the keyboard
	this.textareaMessage=this.form.elements["giftTicketMessage"];
	for(var i=0; i<GiftCertificateForm.prototype.___textEvents.length; i++)
	{
		this.textareaMessage.addEventListener(GiftCertificateForm.prototype.___textEvents[i], GiftCertificateForm.prototype.___instance.onMessageChange);	
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
}

with(GiftCertificateForm)
{
	prototype.___textEvents=["keypress", "paste", "drop"];
	prototype.___instance=null;//kind of single tone, "static" __instance keeps the uniques GiftCertificateForm instance
	
	prototype.onAmountChange=GiftCertificateForm_onAmountChange;
	prototype.onThemeChange=GiftCertificateForm_onThemeChange;
	prototype.onMessageChange=GiftCertificateForm_onMessageChange;
}
function GiftCertificateForm_onAmountChange(evt)
{
	console.log(evt);
}
function GiftCertificateForm_onThemeChange(evt)
{
	console.log(evt);
}
function GiftCertificateForm_onMessageChange(evt)
{
	console.log(evt);
}