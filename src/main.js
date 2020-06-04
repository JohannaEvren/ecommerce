
$(document).ready(function() {

				

$('.delete-prod-btn').on('click', deleteProductAjax)

$('.delete-user-btn').on('click', deleteUserAjax)


});

	function deleteProductAjax(e) {
		
		e.preventDefault();

		let id = $(this).parent().parent().find('input[name="postid"]');
		console.log(id.val());

		$.ajax({
			type: 'POST', 
			url: '../../src/deleteProducts.php' , 
			data: {deletebtn: true, prodId: id.val()},
			dataType: 'json',
			success: function(data){
				console.log(data);
				appendProdList(data);

			}
			
		});
	};


function deleteUserAjax(f) {
		
		f.preventDefault();

		let userId = $(this).parent().parent().find('input[name="postid"]');
		console.log(userId.val());

		$.ajax({
			type: 'POST', 
			url: '../../src/deleteUser.php', 
			data: {deletebtn: true, userId: userId.val()},
			dataType: 'json' ,
			success: function(data){
				appendUserList(data);
				

			}
			
		});
	};

	function appendProdList(data){

		let productList = $('#ProdList');
		let html = '';

		for (product of data['products']) {

				 html +=  '<tr>' + 
		                      '<td>' + product["title"] + '</td>' +
		                      '<td>' + product["description"] + ' </td>' + 
		                      '<td>' + product["price"] + 'SEK' + ' </td>'+ 
		                      '<form action="editproduct.php" method="GET">' + 
		                      	'<td><input type="submit" class="btn btn-info" name="edit" value="EDIT"></td> ' + 
		                      	'<input type="hidden" name="postid" value="' + product["id"]+ '">' +
		                      '</form>' + 
		                      '<form method="POST">' + 
		                          '<td><input type="submit" class="btn btn-info delete-prod-btn" id="delete-btn" name="delete" value="DELETE"></td>' +
		                          '<input type="hidden" name="postid" value="' + product["id"] + '">' + 
		                       '</form>' +    
	                       '</tr> ';                    

					};
					productList.html(html);
					$('.delete-prod-btn').on('click', deleteProductAjax)

		
	}


	function appendUserList(data){

		let userList = $('#userList');
		let html = '';

					for (user of data['users']) {

		

							 html +=  '<tr>' + 
					                      '<td>' + user["first_name"] + '</td>' +
					                      '<td>' + user["last_name"] + ' </td>' + 
					                     
					                      '<form action="edituser.php" method="GET">' + 
					                      	'<td><input type="submit" class="btn btn-info" name="edit" value="EDIT"></td> ' + 
					                      	'<input type="hidden" name="postid" value="' + user["id"]+ '">' +
					                      '</form>' + 
					                      '<form method="POST">' + 
					                          '<td><input type="submit" class="btn btn-info delete-user-btn" id="delete-btn" name="delete" value="DELETE"></td>' +
					                          '<input type="hidden" name="postid" value="' + user["id"] + '">' + 
					                       '</form>' +    
				                       '</tr> '; 



                     
					};
					userList.html(html);
					$('.delete-user-btn').on('click', deleteUserAjax)

		
	}


