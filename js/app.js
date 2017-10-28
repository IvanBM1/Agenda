$( document ).ready(function() {

	var contact = new Object();

	$('#spin').hide();
	$('#alert').hide();
	$('#box').hide();
	$('#btn_send_create').hide();
	$('#btn_send_edit').hide();

	$('#btn_alert').click(function(event) {
		$('#alert').hide(1000);
	});

	$('#btn_close_box').click(function() {
		$('#box').hide(1000);
	});

	$('#close-session').click(function(event){
		event.preventDefault();
		location.href ="../php/close_session.php";
	});

	$('#btn_create').click(function(event){
		event.preventDefault();

		if( $('#box').is(":visible") &&  $('#title_box').html() ==  "Nuevo Contacto"){
			$('#box').hide(1000);
		}else{
			changeButtonsToInputs();
			setVoidContactValues();

			$('#title_box').html("Nuevo Contacto");
			$('#btn_send_edit').hide();
			$('#btn_send_create').show();
			$('#box').hide();
			$('#box').show(1000);
		}
	});

	$('#btn_send_create').click(function(event){
		
		event.preventDefault();
		
		getContactValues();
		if( !checkTheFields() ) return;

		$('#spin').show();
		$.ajax({
			method: "POST",
			url: "../php/create_contact.php",
			dataType: "json",
			data: {
				name : contact.name,
				telephone_local : contact.telephone_local,
				telephone_mobile : contact.telephone_mobile,
				email : contact.email,
				address : contact.address,
				id_user : contact.id_user
			}
		}).done(function( json ) {
			console.log(json);
			if( json.error == true ){
				$('#alert').removeClass( "alert-success" ).addClass( "alert-danger" );
				$('.message').html(json.info);
				$('#alert').show(1000);
			}else{
				$('#alert').removeClass( "alert-danger" ).addClass( "alert-success" );
				$('.message').html("Contacto agregado");
				$('#alert').show(1000);
				setInterval(function(){
					$('#box').hide(1000);
				}, 3000);
				setInterval(function(){
					location.reload(true);
				},5000);
			}

		}).fail(function(error, status) {
		    alert( "error" );
		    console.log(error);
		}).always(function() {
			$('#spin').hide(1000);
		});
	});

	$('#btn_send_edit').click(function(event) {
		
		event.preventDefault();
		
		getContactValues();
		if( !checkTheFields() ) return;

		$('#spin').show();
		$.ajax({
			method: "POST",
			url: "../php/update_contact.php",
			dataType: "json",
			data: {
				id : contact.id,
				name : contact.name,
				telephone_local : contact.telephone_local,
				telephone_mobile : contact.telephone_mobile,
				email : contact.email,
				address : contact.address,
				id_user : contact.id_user
			}
		}).done(function( json ) {
			console.log(json);
			if( json.error == true ){
				$('#alert').removeClass( "alert-success" ).addClass( "alert-danger" );
				$('.message').html(json.info);
				$('#alert').show(1000);
			}else{
				$('#alert').removeClass( "alert-danger" ).addClass( "alert-success" );
				$('.message').html("Contacto actualizado.");
				$('#alert').show(1000);
				setInterval(function(){
					$('#box').hide(1000);
				}, 3000);
				setInterval(function(){
					location.reload(true);
				},5000);
			}
		}).fail(function(error, status) {
		    alert( "error" );
		    console.log(error);
		}).always(function() {
			$('#spin').hide(1000);
		});
	});

	$('.btn_show').click(function() {

		if( $('#box').is(":visible") &&  $('#title_box').html() ==  "Información del Contacto"){
			$('#box').hide(1000);
		}else{
			$('#title_box').html("Información del Contacto");
			$('#btn_send_create').hide();
			$('#btn_send_edit').hide();
			$('#box').hide();
			$('#box').show(1000);

			$('#spin').show();
			var id = $(this).attr('max');

			$.ajax({
				method: "POST",
				url: "../php/get_contact.php",
				dataType: "json",
				data: { id : id }
			}).done(function( json ) {
				console.log(json);
				setContactValues(json);
				changeInputsToButtons();

			}).fail(function(error, status) {
			    alert( "error" );
			    console.log( error );
			}).always(function() { 
				$('#spin').hide(1000);
			});
		}		
	});

	$('.btn_edit').click(function() {

		if( $('#box').is(":visible") &&  $('#title_box').html() ==  "Editar Contacto" ){
			$('#box').hide(1000);
		}else{
			changeButtonsToInputs();
		
			$('#title_box').html("Editar Contacto");
			$('#btn_send_create').hide();
			$('#btn_send_edit').show();
			$('#box').hide();
			$('#box').show(1000);

			$('#spin').show();

			var id = $(this).val();
			
			$.ajax({
				method: "POST",
				url: "../php/get_contact.php",
				dataType: "json",
				data: { id : id }
			}).done(function( json ) {
				console.log(json);
				setContactValues(json);
			}).fail(function(error, status) {
			    alert( "error" );
			    console.log( error );
			}).always(function() { 
				$('#spin').hide(1000);
			});
		}
	});

	$('.btn_delete').click(function() {
		var id = $(this).val();

		if(confirm("Desea borrar el contacto?") == true){
			$.ajax({
				method: "POST",
				url: "../php/delete_contact.php",
				dataType: "json",
				data: { id : id }
			}).done(function( json ) {
				console.log(json);
				if( json.error )
					alert( json.info );
				else{
					setInterval(function(){
						$('#box').hide(1000);
					}, 1000);
					setInterval(function(){
						location.reload(true);
					},2000);
				}

			}).fail(function(error, status) {
			    alert( "error" );
			    console.log( error );
			});
		}
	});

	function getContactValues(){
		contact.id = $('#id').val();
		contact.name = $('#name').val();
		contact.telephone_local = $('#telephone_local').val();
		contact.telephone_mobile = $('#telephone_mobile').val();
		contact.email = $('#email').val();
		contact.address = $('#address').val();
		contact.id_user = $('#id_user').val();
	}

	function checkTheFields(){
		var exp_name = /^[a-zA-Z\s]{4,}(?!.*[0-9])(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/;
		var exp_telephone = /^[0-9]{7,}(?!.*[a-zA-Z\.\,\_\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/;
		var exp_email = /^[a-zA-Z|0-9|.|_-]+[@][a-zA-Z]{4,}[.][\w.]+(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/;
		var exp_address = /^[a-zA-Z0-9.,-\s]{4,}(?!.*[\_\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\~\^\`\*\¨\:\;])/;

		if( !exp_name.test(contact.name) ){
			$('#alert').removeClass( "alert-success" ).addClass( "alert-danger" );
			$('.message').html("Nombre: Min. 4 caracteres alfabéticos.");
			$('#alert').show(1000);
			return false;
		}

		if( contact.telephone_local != "" )
			if( !exp_telephone.test(contact.telephone_local) ){
				$('#alert').removeClass( "alert-success" ).addClass( "alert-danger" );
				$('.message').html("Teléfono: Min. 7 dígitos.");
				$('#alert').show(1000);
				return false;
			}

		if( contact.telephone_mobile != "" )
			if( !exp_telephone.test(contact.telephone_mobile) ){
				$('#alert').removeClass( "alert-success" ).addClass( "alert-danger" );
				$('.message').html("Telefono: Min. 7 digitos.");
				$('#alert').show(1000);
				return false;
			}

		if( contact.email != "" )
			if( !exp_email.test(contact.email) ){
				$('#alert').removeClass( "alert-success" ).addClass( "alert-danger" );
				$('.message').html("Correo: No valido!.");
				$('#alert').show(1000);
				return false;
			}

		if( contact.address != "" )
			if( !exp_address.test(contact.address) ){
				$('#alert').removeClass( "alert-success" ).addClass( "alert-danger" );
				$('.message').html("Dirección: Min. 4 caracteres alfanuméricos. Opcional(.,-).");
				$('#alert').show(1000);
				return false;
			}
		return true;
	}

	function setContactValues(json){
		$('#id').val(json.id);
		$('#name').val(json.name);
		$('#telephone_local').val(json.telephone_local);
		$('#telephone_mobile').val(json.telephone_mobile);
		$('#email').val(json.email);
		$('#address').val(json.address);
		$('#id_user').val(json.id_user);
	}

	function setVoidContactValues(){
		$('#id').val("");
		$('#name').val("");
		$('#telephone_local').val("");
		$('#telephone_mobile').val("");
		$('#email').val("");
		$('#address').val("");
	}

	function changeInputsToButtons(){
		$('#name').prop('type', 'button');
		$('#telephone_local').prop('type', 'button');
		$('#telephone_mobile').prop('type', 'button');
		$('#email').prop('type', 'button');
		$('#address').prop('type', 'button');
	}

	function changeButtonsToInputs(){
		$('#name').prop('type', 'text');
		$('#telephone_local').prop('type', 'text');
		$('#telephone_mobile').prop('type', 'text');
		$('#email').prop('type', 'text');
		$('#address').prop('type', 'text');
	}

});