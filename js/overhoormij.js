//(c) by Thomas Konings a.k.a. tkon99
//Overhoor systeem
function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function flyBy(content, duration){
	var id = makeid();
	$( "#workspace" ).append( "<h1 id='" + id + "' style='display: none;'></h1>" );
	$("#" + id).append(content);
	$("#" + id).show("slide", { direction: "left" }, 1500).delay(duration).hide("slide", { direction: "right" }, 1500);
	var totaltime = 1500 + duration + 1500;
	return totaltime;
}

function speak(lang, text){
	var lang = lang.toLowerCase();
	switch (lang) {
		case 'nederlands':
		case 'dutch':
		case 'nl':
			voice = "eurdutchfemale";
			service = "ispeech";
			break;
		case 'engels':
		case 'english':
		case 'en':
			voice = "32";
			service = "natural";
			break;
		case 'frans':
		case 'français':
		case 'francais':
		case 'fr':
			voice = "21";
			service = "natural";
			break;
	}
	if(service == "ispeech"){
		var url = 'http://www.ispeech.org/p/generic/getaudio?text=' + text + '%2C&voice=' + voice + '&speed=0&action=convert';
	}else if(service == "natural"){
		var token = $("#naturaltoken").html();
		var url = 'http://api.naturalreaders.com/v2/tts/?t=' + text + '&r=' + voice + '&s=1&requesttoken=' + token;
	}
	var audio = new Audio();
	audio.src = url;
	audio.play();
}

function overhoorStart(){
	var data = $("#data").text();
	var obj = jQuery.parseJSON(data);
	flyBy("Start overhoring", 2000);
	var time = flyBy(obj.title, 2000);
	speak("nederlands", "Start overhoring");
	setTimeout(function() {
        flyBy("Vraag:", 2000);
		speak("nederlands", "Vraag" + obj.langa);
		var time2 = flyBy(obj.langa, 2000);
		setTimeout(function() {
			flyBy("Antwoord:", 2000);
			flyBy(obj.langb, 2000);
			speak("nederlands", "Antwoord" + obj.langb);
		}, time2);
    }, time);
	
	var begin = time*3;
	var words = obj.words.word;
	var length = words.length;
	var timer = 0;
	//alert(words[0]['word-a']);
	setTimeout(function() {
		for (var i = 0; i < length; i++) {
			setTimeout(function() {
				var array = $.makeArray(words);
				var question = array[i];
				var word = question['word-a'];
				timer = timer + speak(obj.langa, word);
			}, timer);
		}
    }, begin);
}