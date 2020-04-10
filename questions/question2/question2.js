let arrayOfWords = [
	"escapology",
	"brightwork",
	"verkrampte",
	"protectrix",
	"nudibranch",
	"grandchild",
	"newfangled",
	"flugelhorn",
	"mythologer",
	"pluperfect",
	"jellygraph",
	"quickthorn",
	"rottweiler",
	"technician",
	"cowpuncher",
	"middlebrow",
	"jackhammer",
	"triphthong",
	"wunderkind",
	"dazzlement",
	"jabberwock",
	"witchcraft",
	"pawnbroker",
	"thumbprint",
	"motorcycle",
	"cryptogram",
	"torchlight",
	"bankruptcy",
];

/**
 * find word inside arrayOfWord, i have used for loop becuase it is much faster
 * and loop ends if value is found
 * @param word
 * @returns {boolean}
 */
const hasWord = (word) => {
	let found = false // flag default value
	for(let i=0; i < arrayOfWords.length; i++){
		if(arrayOfWords[i].toLowerCase() === word.toLowerCase()){
			found = true
			document.getElementById(arrayOfWords[i]).style.backgroundColor = 'blue';
			document.getElementById(arrayOfWords[i]).style.color = 'white';
			document.getElementById(arrayOfWords[i]).innerHTML = `${arrayOfWords[i]}  found`;
			break;
		}
	}
	if(found === false){
		alert("word not found")
	}
	return found;
}

/**
 * Print arrayOfWords values in the pre tag
 * @param data
 */
const appendData = (data) => {
	let div = document.getElementById('result');

	if(typeof data === "object"){
		for(let i=0; i<data.length; i++){
			div.innerHTML += `<pre class="pre" id="${data[i]}">${data[i]}</pre>`
		}
	}
}

//print arrayfWords value
appendData(arrayOfWords);

let button = document.getElementById('find');

button.addEventListener("click", function(){
	let word = document.getElementById('word').value;
	let pre = document.getElementsByClassName('pre');
	for(i=0; i<pre.length ; i++){
		pre[i].style.backgroundColor = '#9b979c';
	}
	//if user type word than call hasWord
	if(word){
		hasWord(word);
	}
});
