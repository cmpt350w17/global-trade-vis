


//changes the selected menu button
function menuSelect (element){ 
	//clearClass(activeButton);
	elements = document.getElementsByClassName("activeButton");
	for(var i = 0; i < elements.length; i++){
		elements[i].className = "";
	}
	element.className= "activeButton";
	
}

function anotherFunc(){
	
	return; 
}

