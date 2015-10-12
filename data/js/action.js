function toggleFild(el){
	el.style.height= (el.style.height=='auto') ? '10px' : 'auto';
}
function checkFields(){
	setInterval(function(){
		var login = document.getElementById('login');
		var pass = document.getElementById('pass');
		var name = document.getElementById('name');
		var secondname = document.getElementById('secondname');
		var surname = document.getElementById('surname');
		var sex = document.getElementById('sex');
		var born = document.getElementById('born');
		var send = document.getElementById('send');
		if((login.value=='')||(pass.value=='')||(name.value=='')||(secondname.value=='')||(surname.value=='')||(sex.value=='')||(born.value=='')){
			send.disabled = true;
		}else send.disabled = false;
	},1000)
}