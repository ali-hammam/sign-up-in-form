$(document).ready(function(){
	const name = localStorage.getItem('name');
	if(!name){
		window.location.href = "http://localhost:8000/signIn";
	}else{
		$('#user').html('Welcome ' +  name);
		localStorage.removeItem('name');
	}
})