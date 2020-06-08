$(document).ready(function() {
  
	$('.delete-user-btn').on('click', deleteUserEvent);
	function deleteUserEvent(e) {
		e.preventDefault();
		
		let id = $(this).parent().find('input[name="id"]');
		console.log(id.val());
		$.ajax({
			method: 'POST',
			url: 'deletemyaccount_ajax.php',
			data: { 
				deleteUserBtn: true, 
				id: id.val() 
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				window.location.href='login.php?logout'; // NÄR JAG BYTER TILL DENNA SIDA HOPPAR JU UPPDATERAR KNAPPEN TILL ÄNDÅ. RÄKNAS DET? GÖR PÅ UPDATE
			},
		});
	}


	$('.update-user-btn').on('click', updateUserEvent);
	function updateUserEvent(e) {
		e.preventDefault();
		
		let first_name      = $('input[name="firstname"]');
		let last_name       = $('input[name="lastname"]');
		let email           = $('input[name="email"]');
		let phone           = $('input[name="phone"]');
		let street          = $('input[name="street"]');
		let postal_code     = $('input[name="postalcode"]');
		let city            = $('input[name="city"]');
		let country         = $('input[name="country"]');
		let password        = $('input[name="password"]');
		let confirmPassword = $('input[name="confirmPassword"]');
		// console.log(id.val());
		// console.log(pun.val());
		$.ajax({
			method: 'POST',
			url: 'updateuser_ajax.php',
			data: { 
				register: true, 
				first_name: first_name.val(),
				last_name: last_name.val(),
				email: email.val(),
				phone: phone.val(),
				street: street.val(),
				postal_code: postal_code.val(),
				city: city.val(),
				country: country.val(),
				password: password.val(),
				confirmPassword: confirmPassword.val()
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				$('#message-field').html(data['message']);
				
			},
		});
	}

/* Ifall jag behöver
	function appendUserList(data) {
		let html = '';
		console.log(data);
		for (user of data['users']) {
            

			html +=
			'<div class="userinfo">' +
	            '<p>User Id:</p>' + user['id'] +
	            '<p>Firstname:</p>' + user['first_name'] +
	            '<p>Lastname:</p>' + user['last_name'] + 
	            '<p>Email:</p>' + user['email'] +
	            '<p>Password:</p>' + user['password'] + 
	            '<p>Phone:</p>' + user['phone'] + 
	            '<p>Street:</p>' + user['street'] + 
	            '<p>Postal Code:</p>' + user['postal_code'] +
	            '<p>City:</p>' + user['city'] +
	            '<p>Country:</p>' + user['country']
	            '<p>Register Date:</p>' + user['register_date'] + '<br>' +
            '</div>' +
            '<form action="update-user.php" method="GET">' +
	            '<input type="hidden" name="id" value="' + user['id'] +'">' +
	            '<input type="submit" value="Update">' +
            '</form>' +
	        '<form action="" method="POST">' + 
	            '<input type="hidden" name="id" value="' + user['id'] + '">' +
	            '<input type="submit" name="deleteUserBtn" value="Delete this account" class="delete-user-btn">' +
	        '</form>';
		}

		$('#userinfo').html(html);

		// Add eventlisteners
		$('.delete-user-btn').on('click', deleteUserEvent);
	}
	*/
});	

