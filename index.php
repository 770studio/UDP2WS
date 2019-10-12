<script src="https://code.jquery.com/jquery-1.8.3.js"></script> 

<style>
  @-webkit-keyframes argh-my-eyes-red {
    0%   { background-color: red; color: black; }
    49% { background-color: red;  color: black;}
    50% { background-color: #fff; color: black;  }
    99% { background-color: #fff; color: black; }
    100% { background-color: red; color: black; }
  }
  @-moz-keyframes argh-my-eyes-red {
    0%   { background-color: red; color: black; }
    49% { background-color: red; color: black; }
    50% { background-color: #fff; color: black; }
    99% { background-color: #fff; color: black; }
    100% { background-color: red;  color: black; }
  }
  @keyframes argh-my-eyes-red {
    0%   { background-color: red;  color: black; }
    49% { background-color: red; color: black; }
    50% { background-color: #fff; color: black; }
    99% { background-color: #fff; color: black; }
    100% { background-color: red; }
  }
  
    @-webkit-keyframes argh-my-eyes-green {
    0%   { background-color: green; color: black; }
    49% { background-color: green; color: black; }
    50% { background-color: #fff; color: black; }
    99% { background-color: #fff; color: black;}
    100% { background-color: green; color: black; }
  }
  @-moz-keyframes argh-my-eyes-green {
    0%   { background-color: green; color: black; }
    49% { background-color: green; color: black; }
    50% { background-color: #fff; color: black; }
    99% { background-color: #fff; color: black; }
    100% { background-color: green;  color: black; }
  }
  @keyframes argh-my-eyes-green {
    0%   { background-color: green; color: black; }
    49% { background-color: green; color: black; }
    50% { background-color: #fff; color: black; }
    99% { background-color: #fff; color: black; }
    100% { background-color: green; color: black; }
  }
  .green_blink  {
  -webkit-animation: argh-my-eyes-green 1s infinite;
  -moz-animation:    argh-my-eyes-green 1s infinite;
  animation:         argh-my-eyes-green 1s infinite;
}  
  
  .red_blink {
  -webkit-animation: argh-my-eyes-red 1s infinite;
  -moz-animation:    argh-my-eyes-red 1s infinite;
  animation:         argh-my-eyes-red 1s infinite;
}

.green {
    color: #FFF !important;
    background: green;
    !important;
}

.red {
    color: #FFF !important;
    background: red;
    !important;
}

</style>
<script>



$(document).ready(function () {
	var conn = new WebSocket('wss://ds.cucos.de/design:8080'); 

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
  
//console.log(tile)
 



 

var color, flash;
switch (res[1]) {
  case '2': // Opening = 2 / Green flashing every Second 
     color = 'green'
	 flash = true;
	 $(tile).removeClass();
	   $(tile).addClass("green_blink" );
	 
    break;
  case '6': // Closing = 6 / Red flashing every second 
     color = 'red'
	 flash = true;
	 $(tile).removeClass();
	 	   $(tile).addClass("red_blink" );

    break;
  case '5':  // Open = 5 / Green
     color = 'green'
	 flash = false;
	 $(tile).removeClass();
	   $(tile).addClass("green" );
	break;
  case '1':  // Closed = 1 / Red
     color = 'red'
	 flash = false;
	 $(tile).removeClass();
	  $(tile).addClass("red" );
	break;
	
  default:
    
}

          
 

			
		}
	};

	
	
	
 
});

 
</script> 



<div style="width: 100%; height: 600px;">
<div style="background-color: #aaa; height: 70%; width: 20%; float: left;">
<div>&nbsp;</div>
Overlayer 2</div>
<div style="background-color: #eee; height: 70%; width: 80%; float: left;">
<p>Image/Video area</p>
</div>
<div style="height: 30%;     font-size: 80px; color: white; clear: both; background-color: red; width: 100%;">
<div id="k1" style="width: 25%; display: table; text-align: center;  height: 100%; float: left;  ">
<span style="
    display: table-cell;
    vertical-align: middle;
">1</span>
</div>
<div  id="k2"  style="width: 25%; display: table; text-align: center;  height: 100%; float: left; ">
<span style="
    display: table-cell;
    vertical-align: middle;
">2</span>
</div>
<div id="k3"  style="width: 25%; display: table; text-align: center;  height: 100%; float: left;  ">
<span style="
    display: table-cell;
    vertical-align: middle;
">3</span>
</div>
<div id="k4"  style="width: 25%; display: table; text-align: center;  height: 100%; float: left; ">
<span style="
    display: table-cell;
    vertical-align: middle;
">4</span>
</div>
</div>
</div>