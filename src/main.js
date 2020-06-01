
$(document).ready(function() {

				

$('.delete-btn').on('click', function(e) {

		e.preventDefault();

		let id = $(this).parent().parent().find('input[name="postid"]');


		console.log(id.val());

		$.ajax({
			type: 'POST', 
			url: '../../src/delete.php' , 
			data: {deletebtn: true, prodId: id.val()},
			datatype: 'json',
			success: function(data){
				
				console.log(data);


				 for (product of data['products']) {


				 			let html  = ' <tr>' + 
                                      
                                      '<td>product["title"]</td>' +
                                      

                                      '<td>product["description"]</td>' + 
                                      '<td>product["price"] + SEK</td>'+ 
                                     
                   
                                      '<form action="editproduct.php" method="GET">' + 
                                      '<td><input type="submit" class="btn btn-info" name="edit" value="EDIT"></td> ' + 
                                      '<input type="hidden" name="postid" value="product["id"]">' +
                                      '</form>' + 
                                      ' <form method="POST">' + 
                                      '<td><input type="submit" class="btn btn-info delete-btn" id="delete-btn" name="delete" value="DELETE"></td>' +
                                      '<input type="hidden" name="postid" value="product["id"]?>">' + 
                                      '</form>' + 
                                    
                                      '</tr> ';

				
				
	

				};
			}
				

			
		});


});


});