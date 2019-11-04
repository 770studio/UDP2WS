<style>

    .udp2ws_block {
        width: {blockWidth};
        height: {blockHeight};
        display: table;
        text-align: center;
        float: left;
    }

    span.caption {
        display: table-cell;
        vertical-align: middle;

    }

    div.border {

        width: {borderWidth};
        display: table;
        text-align: center;
        height: {borderHeight};
        float: left;
        background-color:{borderBackgroundColor};

    }

     #udp2ws_block_Wrapper {
         height: {totalHeight};
         width: {totalWidth};
         position: fixed;
         font-size: {fontSize};
         color: {textColor};
         clear: both;
         background-color: {backgroundColor};
     }

    @-webkit-keyframes argh-my-eyes-red {
        0%   { background-color: {redColor}; color: {textColor}; }
        49% { background-color: {redColor};  color: {textColor};}
        50% { background-color: {blinkColor}; color: {blinktextColor};  }
        99% { background-color: {blinkColor}; color: {blinktextColor}; }
        100% { background-color: {redColor}; color: {textColor}; }
    }
    @-moz-keyframes argh-my-eyes-red {
        0%   { background-color: {redColor}; color: {textColor}; }
        49% { background-color: {redColor}; color: {textColor}; }
        50% { background-color: {blinkColor}; color: {blinktextColor}; }
        99% { background-color: {blinkColor}; color: {blinktextColor}; }
        100% { background-color: {redColor};  color: {textColor}; }
    }
    @keyframes argh-my-eyes-red {
        0%   { background-color: {redColor};  color: {textColor}; }
        49% { background-color: {redColor}; color: {textColor}; }
        50% { background-color: {blinkColor}; color: {blinktextColor}; }
        99% { background-color: {blinkColor}; color: {blinktextColor}; }
        100% { background-color: {redColor}; }
    }

    @-webkit-keyframes argh-my-eyes-green {
        0%   { background-color: {greenColor}; color: {textColor}; }
        49% { background-color: {greenColor}; color: {textColor}; }
        50% { background-color: {blinkColor}; color: {blinktextColor}; }
        99% { background-color: {blinkColor}; color: {blinktextColor};}
        100% { background-color: {greenColor}; color: {textColor}; }
    }
    @-moz-keyframes argh-my-eyes-green {
        0%   { background-color: {greenColor}; color: {textColor}; }
        49% { background-color: {greenColor}; color: {textColor}; }
        50% { background-color: {blinkColor}; color: {blinktextColor}; }
        99% { background-color: {blinkColor}; color: {blinktextColor}; }
        100% { background-color: {greenColor};  color: {textColor}; }
    }
    @keyframes argh-my-eyes-green {
        0%   { background-color: {greenColor}; color: {textColor}; }
        49% { background-color: {greenColor}; color: {textColor}; }
        50% { background-color: {blinkColor}; color: {blinktextColor}; }
        99% { background-color: {blinkColor}; color: {blinktextColor}; }
        100% { background-color: {greenColor}; color: {textColor}; }
    }
    .green_blink  {
        -webkit-animation: argh-my-eyes-green {blinkTime} infinite;
        -moz-animation:    argh-my-eyes-green {blinkTime}1 infinite;
        animation:         argh-my-eyes-green {blinkTime} infinite;
    }

    .red_blink {
        -webkit-animation: argh-my-eyes-red {blinkTime} infinite;
        -moz-animation:    argh-my-eyes-red {blinkTime} infinite;
        animation:         argh-my-eyes-red {blinkTime} infinite;
    }

    .green {
        color: {blinkColor} !important;
        background: {greenColor}  !important;
    }

    .red {
        color: {blinkColor} !important;
        background: {redColor}  !important;
    }

</style>

