$(document).ready(function() {
  
	$('.delete-user-btn').on('click', deleteUserEvent);
	function deleteUserEvent(e) {
		e.preventDefault();
		
		let id = $(this).parent().find('input[name="id"]');
		console.log(id.val());
		$.ajax({
			method: 'POST',
			url: 'deletemyaccount.php',
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
			url: 'updateuser.php',
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
});	

