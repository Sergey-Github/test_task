'use strict';

$(document).ready(
	getData()
);

function insertData(){

	var name = document.getElementById('inputName').value.trim();
	var email = document.getElementById('inputEmail').value.trim();
	var comment = document.getElementById('textareaComment').value.trim();

	$.ajax({  
		url:"php/insertData.php",
		method:"POST",  
		data:{'name': name, 'email': email, 'comment': comment},  
		dataType:"text",  
		success:function(data)  
			{  
					console.log(data);
				// alert(data);
				if (!data.length){
					alert("Ошибка на сервере, попробуйте позже");
				}
				else{
					var jsonData = JSON.parse(data);
					showData(jsonData[0], jsonData[1], jsonData[2]);
				}
			}
	});
}

function getData() {
	$.ajax({  
		url:"php/getData.php",
		method:"POST",  
		data:{},  
		dataType:"text",  
		success:function(data)  
			{

				if (!data.length) {
					alert("Ошибка на сервере, попробуйте позже. Данные не получены");
				}
				else{
					var jsonData = JSON.parse(data);
					
					for (var i = 0; i < jsonData.length; i++) {
						showData(jsonData[i][1], jsonData[i][2], jsonData[i][3])
					}
				}

			}
	});
}

function showData(name, email, comment) {
	
	// Создание карточки
	var card = $('.main .row:last-child').prepend("<div class='card .bg-transparent col-lg-4 col-sm-6 col-12 mx-auto ml-xl-4 mr-xl-4'></div>").find(">:first-child");
	
	// Создание заголовка (имя)
	card.prepend("<div class='card-header'>"+ name +"</div>");

	// Получение тела карточки
	var cardBody = card.append("<div class='card-body'></div>").find('div:last-child');

	cardBody.append("<h2 class='card-title'>"+ email +"</h2>");

	cardBody.append("<p class='card-text'>"+ comment +"</div>")
}