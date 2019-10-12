<script src="http://code.jquery.com/jquery-1.8.3.js"></script> 

<style>
.blink_red {
    color: #FFF !important;
    background: red;
    !important;
}
.blink_green {
    color: #FFF !important;
    background: green;
    !important;
}
 

</style>
<script>



$(document).ready(function () {
	var conn = new WebSocket('ws://ds.cucos.de/design:8080'); 

	conn.onopen = function(e) {
		console.log("Connection established!");
	};

	conn.onmessage = function(e) {
		console.log(e.data);
		var res = e.data.split("");
		console.log(res)
		if(res) {
			
/*
You get everytime over udp a 3 letter signal. 
First letter is everytime the till number.
Second Number is status. For example: 
Till 1 is open = UDP: 150 
Till 2 is open = UDP: 250 …
Till 5 is open = UDP: 550 

We have 5 different status: 
Opening = 2 
Open = 5 
Repeat = 3 
Closing = 6 
Closed = 1 
Means when till is changed status to closed you get UDP: 110 If till 2 closed you get UDP: 210 Same for all other status.
Logic implementation for the number Blocks (change BG): 

Opening = 2 / Green flashing every Second 
Open = 5 / Green
Repeat = 3 / this is special status. 
We need it later 
Closing = 6 / Red flashing every second 
Closed = 1 / Red
*/


var tile =  '#k' + res[0] ;
 timer = new Array;
console.log(tile)
//removeBlink( tile )
$(tile).removeClass("blink_green"  )
$(tile).removeClass("blink_red"  )


 
switch (res[1]) {
  case '2': // Opening = 2 / Green flashing every Second 
    blinkstop = false;
    blink( tile, -1, 1000, 'green' ); 
    break;
  case '6': // Closing = 6 / Red flashing every second 
     blinkstop = false;
    blink( tile, -1, 1000, 'red' ); 
    break;
  case '5':  // Open = 5 / Green
	if(typeof timer[tile] != 'undefined') clearTimeout(timer[tile]);
	$(tile).addClass("blink_green" );
	break;
  case '1':  // Closed = 1 / Red
	if(typeof timer[tile] != 'undefined') clearTimeout(timer[tile]);
	$(tile).addClass("blink_red" );
	break;
	
  default:
    
}

			
		}
	};

	
	
	

    //call the blink function on the element you want to blink
   // blink("#myDiv", 4, 500); //blink a div with the ID of myDiv
   // blink("input[type='submit']", 3, 1000); //blink a submit button
   // blink("ol > li:first", -1, 100); //blink the first element in an ordered list (infinite times)
    // blink(".myClass", 25, 5000); //blink anything that has a myClass on it
});

/* Purpose: blink a page element
 * Preconditions: the element you want to apply the blink to, the number of times to blink the element (or -1 for infinite times), the speed of the blink
 **/
function blink(elem, times, speed, color  ) {
    if (times > 0 || times < 0) {
		//removeBlink( elem )
		
        if ($(elem).hasClass("blink_" + color)) 
             $(elem).removeClass("blink_" + color);
        else
            $(elem).addClass("blink_" + color);
    }

    clearTimeout(function () {
        blink(elem, times, speed, color);
    });

    if (times > 0 || times < 0) {
       timer[elem] = setTimeout(function () {
            blink(elem, times, speed, color);
        }, speed);
        times -= .5;
    }
}


function removeBlink( elem ) {
	$(elem).removeClass (function (index, className) {
			return (className.match (/(^|\s)blink_\S+/g) || []).join(' ');
		});
	
}



</script> 



<div style="width: 100%; height: 600px;">
<div style="background-color: #aaa; height: 70%; width: 20%; float: left;">
<div>&nbsp;</div>
Overlayer 2</div>
<div style="background-color: #eee; height: 70%; width: 80%; float: left;">
<p>Image/Video area</p>
</div>
<div style="height: 30%; clear: both; background-color: white; width: 100%;">
<div id="k1" style="width: 25%; height: 100%; float: left;  ">
<p>Kasse 1</p>
</div>
<div  id="k2" style="width: 25%; height: 100%; float: left;  ">
<p>Kasse 2</p>
</div>
<div id="k3"  style="width: 25%; height: 100%; float: left;  ">
<p>Kasse 3</p>
</div>
<div id="k4"  style="width: 25%; height: 100%; float: left;  ">
<p>Kasse 4</p>
</div>
</div>
</div>