$('document').ready(function(){
	loadTovars();
});

function loadTovars() {
	//загрузка товаров на страницу
	$.getJSON('tovars.json', function (data) {
		//console.log(data);
		var out = '';
		for (var key in data) {
			out+='<p>'+data[key]['name']+'</p>';
			out+='<p>'+data[key]['cost']+'</p>';
		}
		$('#tovars').html(out);
	})
}