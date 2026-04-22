window.onload=
function(){
//alert('НАЧАЛО-ССССССССССССССС');
$.post('a1uplo.php', {begi:1}, result);
};

var idvideo= null;
function goacti(){
MediaStreamTrack.getSources(function(sourceInfos) {
  var audioSource = null;
  var videoSource = null;
  for (var i = 0; i != sourceInfos.length; ++i) {
    var sourceInfo = sourceInfos[i];
    if (sourceInfo.kind === 'video') {
				if (sourceInfo.facing === 'environment'){
idvideo= sourceInfo.id;
				}else{
				}
	} else {
		console.log('друг източник : ', sourceInfo);
//      alert('друг източник: ', sourceInfo);
    }
  }

	var video = document.getElementById('video'),
   canvas = document.getElementById('canvas'),
   context = canvas.getContext('2d'),
//   photo = document.getElementById('photo'),
   vendorUrl = window.URL || window.webkitURL;
   navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.
mozGetUserMedia || navigator.msGetUserMedia;
  navigator.getMedia({
//   video: true,
//   video: {facing:'environment'},
    video: {
    optional: [{sourceId: idvideo}]
	},
//			video:{sourceId:idvideo},
   audio: false
  }, function(stream) {
   video.src = vendorUrl.createObjectURL(stream);
   video.play();
  }, function(error) {
   alert('системна грешка');
  });

//----------------------------------------------------------
  document.getElementById('capture').addEventListener('click', function() {
   context.drawImage(video, 0, 0, 1000, 1500);
	$.post('a1uplo.php', {imag:canvas.toDataURL('image/jpeg')}, result
			);
});
//----------------------------------------------------------
  
});
  
};


function goregi(){
//alert("goregi");
	$.post('a1uplo.php', {un:$("#username").val(),pw:$("#password").val()}, result);
}
function result(data){
//alert(data);
var nl= String.fromCharCode(10);
	var arre= data.split("^");
	var vari= arre[0];
	var stri= arre[1];
	if (0){
	}else if(vari=="1") {
alert("OK - снимката е записана");
	}else if(vari=="2") {
alert("ГРЕШКА"+nl+"снимката не е записана"+nl+"["+stri+"]"+nl+"няма приемащ прозорец");
	}else if(vari=="3") {
alert("ГРЕШКА"+nl+"необходима е регистрация");
show2();
	}else if(vari=="11") {
alert("ГРЕШКА"+nl+"липсва потребителя");
	}else if(vari=="12") {
alert("OK "+stri);
goacti();
show1();
	}else if(vari=="be+") {
goacti();
	}else if(vari=="be-") {
alert("необходима е регистрация");
show2();
	}else{
alert("неопределена грешка "+vari);
	}
}

function show1(){
	$("#div2").hide();
	$("#div1").show();
}
function show2(){
	$("#div1").hide();
	$("#div2").show();
	$("#username").val("");
	$("#password").val("")
}


