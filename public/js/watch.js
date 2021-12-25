var inc = 1000;

clock();

function clock() {
  
  const now = moment(); 
  
  const hours = ((now.hour() + 11) % 12 + 1);
  const minutes = now.minutes();
  const seconds = now.seconds();
  
  const hour = hours * 30;
  const minute = minutes * 6;
  const second = seconds * 6;

  $("#dig-watch").text(moment().format('hh:mm A'));

  document.querySelector('.hour').style.transform = `rotate(${hour}deg)`
  document.querySelector('.minute').style.transform = `rotate(${minute}deg)`
  document.querySelector('.second').style.transform = `rotate(${second}deg)`
}

setInterval(clock, inc);