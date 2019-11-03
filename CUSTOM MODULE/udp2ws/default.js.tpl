<script type="application/javascript">

    $(document).ready(function () {

        wsServer = '{serverUrl}'

        function connect( wsUrl ) {
            var ws = new WebSocket( wsUrl);
            ws.onopen = function() {
                console.log("Connection established :"  + wsUrl  );
                // alert('Connection esatblished:' + wsUrl);

            };

            ws.onmessage = function(e) {
                console.log(e.data);
                let mytest = e.data.split("");
                // console.log(my)
                if (mytest) {
//my.unshift(0);
                    let tile = '#k' + mytest[0];
                    //console.log(tile)
                    let color, flash;
                    let mytest2 = mytest[parseInt('1')];
                    switch (mytest2) {
                        case '2': // Opening = 2 / Green flashing every Second
                            color = 'green'
                            flash = true;
                            $(tile).removeClass();
                            $(tile).addClass("green_blink");

                            break;
                        case '6': // Closing = 6 / Red flashing every second
                            color = 'red'
                            flash = true;
                            $(tile).removeClass();
                            $(tile).addClass("red_blink");

                            break;
                        case '5':  // Open = 5 / Green
                            color = 'green'
                            flash = false;
                            $(tile).removeClass();
                            $(tile).addClass("green");
                            break;
                        case '1':  // Closed = 1 / Red
                            color = 'red'
                            flash = false;
                            $(tile).removeClass();
                            $(tile).addClass("red");
                            break;

                        default:

                    }

                }

            };

            ws.onclose = function(e) {

                console.log('Socket is closed. Reconnect will be attempted in 5 second(s).', e.reason);
                console.log(e.currentTarget.url);

                if (e.wasClean) {
                    // alert('Connection closed properly: code'+e.code+', reason:'+e.reason);
                } else {
                    // e.g. server process killed or network down
                    // event.code is usually 1006 in this case
                    console.log('Connection dead, code:'+e.code+', reason:'+e.reason);
                }
                //	 alert(' retry ' );
                setTimeout(function() {  connect( wsServer );   }, 5000);

            };

            ws.onerror = function(err) {
                console.error('Socket encountered error: ', err.data, 'Closing socket');
                //ws.close();
                console.log('Error message:'+err.message);

            };
        }

        connect(  wsServer );
        //connect( wsServer2 + ':' + 8081 );
    });
</script>