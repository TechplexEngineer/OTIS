
/*
	Javascript to style odd/even table rows
	Derived from 'Zebra Tables' by David F. Miller (http://www.alistapart.com/articles/zebratables/)

	Modified by Jop de Klein, february 2005
	jop at validweb.nl
	http://validweb.nl/artikelen/javascript/better-zebra-tables/
	 */

function stripe()
{
	//console.log('stripe');
	var tables = document.getElementsByTagName("table");

	for(var x=0;x!=tables.length;x++)
	{
		var table = tables[x];

		var test=table.className;
		if (test.toLowerCase().indexOf("omit") != -1)
		{
			console.log("Skipped");
		}
		else
		{
			//console.log("tableid="+table.className)
			if (! table )
				return;

			var tbodies = table.getElementsByTagName("tbody");

			for (var h = 0; h < tbodies.length; h++)
			{

				var trs = tbodies[h].getElementsByTagName("tr");

				for (var i = 0; i < trs.length; i++)
				{
					trs[i].onmouseover=function()
					{
						this.className += " ruled";
						return false
					}
					trs[i].onmouseout=function()
					{
						this.className = this.className.replace("ruled", "");
						return false
					}
					trs[i].className = '';
					if(i%2==0)
					{
//						if(trs[i].className.indexOf('noteven') != -1) //noteven is there
//							trs[i].className = trs[i].className.replace("noteven", "even");
//						else
							trs[i].className += " even";
					}
					else
					{
//						if(trs[i].className.indexOf('even') != -1) //even is there
//							trs[i].className = trs[i].className.replace("even", "noteven");
//						else
							trs[i].className += " noteven";

					}
				}
			}
		}
		//else
			
	}
}

window.onload = stripe;