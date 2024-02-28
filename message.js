// <?php require "navbar.php" ?>


const search = document.getElementById("search");

let timeout;

search.addEventListener("click", alertMessage);

function alertMessage(){
	alert("Message Does Not Found");
	alertFun();
}

function alertFun(){
	timeout = setTimeout(alertMessage, 10000);
}


	