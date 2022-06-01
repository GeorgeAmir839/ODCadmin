var startminute = 30;
var scoundminute = startminute * 60;
var starthourse = 2;
var scoundhourse = starthourse * 60 ;
const timeoutminute=(30*60) + (2 * 60 * 60);
// alert(timeoutminute);
// var hourse=document.getElementById("count-hourse");
    var countdowntimer=document.getElementById("countdowntimer").textContent=scoundminute;
    var countdowntimer=document.getElementById("countdowntimer2").textContent=scoundhourse;

    // var downloadTimer = setInterval(function() {
    //     scoundminute--;
    //     document.getElementById("countdowntimer").textContent = timeleft;
    //     if (timeleft <= 0)
    //         clearInterval(downloadTimer);

    // }, 1000);
    window.onload = function() {
        render();
        render2() 
    };

    function render() {
        var downloadTimer = setInterval(function() {
            // alert("hello");
        scoundminute--;
        document.getElementById("countdowntimer").textContent = scoundminute;
        if (timeleft <= 0)
            clearInterval(downloadTimer);

    }, 1000);

        // $('#resend').prop('disabled', true);
      
    }
   
        setInterval(function() {
         
      

    }, timeoutminute);

        // $('#resend').prop('disabled', true);
      
    
    function render2() {
        var downloadTimer2 = setInterval(function() {
            // alert("hello");
            scoundhourse--;
        document.getElementById("countdowntimer2").textContent = scoundhourse;
        if (timeleft <= 0)
            clearInterval(downloadTimer2);

    }, 60000);

        // $('#resend').prop('disabled', true);
       
    }














//     var startminute = 30;
// var scoundminute = startminute * 60;

// var starthourse = 2;
// var minutehourse = starthourse * 60 ;
// const timeoutminute=scoundminute + (scoundhourse * 60);
// // var hourse=document.getElementById("count-hourse");
//     var countdowntimer=document.getElementById("countdowntimer").textContent=scoundminute;
//     var countdowntimer=document.getElementById("countdowntimer2").textContent=minutehourse;

//     // var downloadTimer = setInterval(function() {
//     //     scoundminute--;
//     //     document.getElementById("countdowntimer").textContent = timeleft;
//     //     if (timeleft <= 0)
//     //         clearInterval(downloadTimer);

//     // }, 1000);
//     window.onload = function() {
//         render();
        
//     };

//     function render() {
//         var downloadTimer = setInterval(function() {
//             // alert("hello");
//         scoundminute--;
//         document.getElementById("countdowntimer").textContent = scoundminute;
//         if (scoundminute <= 0)
//             clearInterval(downloadTimer);

//     }, 1000);

//         // $('#resend').prop('disabled', true);
       
//     }
//     function render2() {
//         var downloadTimer2 = setInterval(function() {
//             // alert("hello");
//         minutehourse--;
//         document.getElementById("countdowntimer2").textContent = minutehourse;
//         if (minutehourse <= 0)
//             clearInterval(downloadTimer2);

//     }, 60000);

//         // $('#resend').prop('disabled', true);
//         setTimeout(function() {
//             alert('done');
//          }, timeoutminute);
//     }