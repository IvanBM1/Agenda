$( document ).ready(function() {

	$('#form-registry').hide();
	$('#spin-session').hide();
	$('#sping-registry').hide();
	$('#alert-session').hide();
	$('#alert-registry').hide();

	$('#btn-show-registry').click(function(){
		$('#form-session').hide(1000);
		$('#form-registry').show(1000);
	});

	$('#btn-show-session').click(function(){
		$('#form-registry').hide(1000);
		$('#form-session').show(1000);
	});

	$('#alert-session-close').click(function(){
		$('#alert-session').hide(1000);
	});

	$('#alert-registry-close').click(function(){
		$('#alert-registry').hide(1000);
	})

	$('#form_session').on('submit', function(event){
		event.preventDefault();

		var name = $('#name-user').val();
		var password = $('#password-user').val();

		var exp_name = /^[a-zA-Z\s]{4,}(?!.*[0-9])(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/;
		var exp_password = /^[a-zA-Z|0-9]{8,}(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/; 

		if( !exp_name.test(name) ){
			$('.session-message').html( "Nombre: Min. 4 caracteres alfabéticos." );
			$('#alert-session').show(1000);
			return;
		}

		if( !exp_password.test(password) ){
			$('.session-message').html( "Contraseña: Min. 8 caracteres alfanuméricos." );
			$('#alert-session').show(1000);
			return;
		}

		$('#spin-session').show();
		$.ajax({
			method: "POST",
			url: "php/session.php",
			dataType: "json",
			data: {
				name : name,
				password : password
			}
		}).done(function( json ) {
			console.log(json);
			if( json.error == false )
				location.href ="./app/home.php";
			else{
				$('.session-message').html( json.info );
				$('#alert-session').show(1000);
			}
		}).fail(function(error, status) {
		    alert( "error" );
		}).always(function() {
			$('#spin-session').hide(1500);
		});

    });

	$('#form_registry').on('submit', function(event){
		
		event.preventDefault();

		var name = $('#registry-name').val();
		var password = $('#registry-password').val();
		var confirm_password = $('#confirm-password').val();

		var exp_name = /^[a-zA-Z\s]{4,}(?!.*[0-9])(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\_\.\,\~\^\`\*\¨\:\;])/;
		var exp_password = /^[a-zA-Z|0-9]{8,}(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\_\.\,\~\^\`\*\¨\:\;])/;

		if( !exp_name.test(name) ){
			$('.registry-message').html("Nombre: Min. 4 caracteres alfabéticos.");
			$('#alert-registry').show(1000);
			return;
		}

		if( !exp_password.test(password) ){
			$('.registry-message').html( "Contraseña: Min. 8 caracteres alfanuméricos." );
			$('#alert-registry').show(1000);
			return;
		}

		if( password != confirm_password ){
			$('.registry-message').html( "Las contraseñas no coinciden." );
			$('#alert-registry').show(1000);
			return;
		}

		$('#sping-registry').show();
		$.ajax({
			method: "POST",
			url: "php/registry.php",
			dataType: "json",
			data: {
				name : name,
				password : password
			}
		}).done(function( json ) {
			console.log(json);
			if( json.error == false )
				location.href ="./app/home.php";
			else{
				$('.registry-message').html( json.info );
				$('#alert-registry').show(1000);
			}
		}).fail(function(error, status) {
		    alert( "error" );
		    console.log( error );
		}).always(function() {
			$('#sping-registry').hide(1500);
		});

	});

});