window.onload = function () {
  
    var seconds = 0; 
    var tens = 0; 
    var mins = 0; 
    var hours = 0; 
    var days = 0; 
    var appendTens = document.getElementById("tens")
    var appendSeconds = document.getElementById("seconds")
    var appendMins = document.getElementById("mins")
    var appendHours = document.getElementById("hours")
    var appendDays = document.getElementById("days")
    var buttonStart = document.getElementById('button-start');
    var buttonStop = document.getElementById('button-stop');
    var buttonReset = document.getElementById('button-reset');
    var Interval ;
  
    buttonStart.onclick = function() {
      
      clearInterval(Interval);
       Interval = setInterval(startTimer, 10);
    }
    
      buttonStop.onclick = function() {
         clearInterval(Interval);
    }
    
  
    buttonReset.onclick = function() {
       clearInterval(Interval);
      tens = "00";
        seconds = "00";
        mins = "00";
        hours = "00";
        days = "00";
      appendTens.innerHTML = tens;
        appendSeconds.innerHTML = seconds;
        appendMins.innerHTML = mins;
        appendHours.innerHTML = hours;
        appendDays.innerHTML = days;
    }
    
     
    
    function startTimer () {
      tens++; 
      
      if(tens <= 9){
        appendTens.innerHTML = "0" + tens;
      }
      
      if (tens > 9){
        appendTens.innerHTML = tens;
        
      } 
      
      if (tens > 99) {
        console.log("seconds");
        seconds++;
        appendSeconds.innerHTML = "0" + seconds;
        tens = 0;
        appendTens.innerHTML = "0" + 0;
      }
      
      if (seconds > 9){
        appendSeconds.innerHTML = seconds;
      }
      if (seconds > 59) {
        console.log("minutes");
        mins++;
        appendMins.innerHTML = "0" + mins;
        seconds = 0;
        appendSeconds.innerHTML = "0" + 0;
      }
      
      if (mins > 9){
        appendMins.innerHTML = mins;
      }
      if (mins > 59) {
        console.log("hours");
        hours++;
        appendHours.innerHTML = "0" + hours;
        mins = 0;
        appendMins.innerHTML = "0" + 0;
      }
      
      if (hours > 9){
        appendHours.innerHTML = hours;
      }
      if (hours > 23) {
        console.log("Days");
        days++;
        appendDays.innerHTML = "0" + days;
        hours = 0;
        appendHours.innerHTML = "0" + 0;
      }
      
      if (days > 9){
        appendDays.innerHTML = days;
      }
      


    }
}