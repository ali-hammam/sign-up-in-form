const fields = [ 'email' , 'password' ];

$(document).ready(function(){
  $("#test").click(function(event){
		event.preventDefault();
		let validator = validateForm();
		if(validator){
			event.preventDefault();
      return false;
		}else{
			$.ajax({
				url: 'http://localhost:8000/compareUsers',
				method: 'POST',
				data: dataObj(),
				error: function (data, status) {
						console.log(data, status)
				}
			}).then((response) => {
				let parsedResponse = JSON.parse(response);
        isUserFound = parsedResponse['data'];
				if(isUserFound){
					localStorage.setItem('name' , isUserFound['name']);
					window.location.href = "http://localhost:8000/"
				}else{
					notUser('password' , ' not found');
				}
			})
		}
  });
});

function validateForm(){
	let err = 0;
	let flag = 0;

	(fields.forEach(function(type){
		selector = $('#'+type).val();
		if(type == 'email'){
		
			const res = validateEmail(selector);
			!res ?  err = errorMsg(type , ' not valid') : err = successMsg(type);
		
		}else if(type === 'password'){
		
			selector.length < 8 ? err = errorMsg(type , ' insecure') : err = successMsg(type);
		
		}

		if(err === 1){
			flag = 1;
		}

	}));
	
	return flag;
}

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

function errorMsg(type , msg){
  $('#'+type).next().css({"visibility": "visible"}).show(250);
	$('#'+ type+'Error').html('* ' + type.toLowerCase() + (msg ||' is required'));
  return 1;
}

function notUser(type , msg){
	$('#'+type).next().css({"visibility": "visible"}).show(250);
	$('#'+ type+'Error').html('* user' + (msg ||' is required'));
}

function successMsg(type){
  $('#'+type).next().css({"visibility": "hidden"}).hide(200);
  return 0;
}

function dataObj(){
	const obj = {};
	
	fields.forEach(type => {
		type === 'password' ? obj[type] = hash($('#'+type).val()) : obj[type] = $('#'+type).val();
	});
	
	return obj;
}

function hash (string) {
	let hash = 0;

	if (string.length == 0) return hash;
	for (i = 0 ;i<string.length ; i++)
	{
		ch = string.charCodeAt(i);
		hash = ((hash << 5) - hash) + ch;
		hash = hash & hash;
	}
	return hash;
}