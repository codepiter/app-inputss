/*Eliminar de bd Menu en index*/
	 var modalConfirm = function(callback){
	  
		  $(".remov-item").on("click", function(){
			  var id = $(this).data("id");
			  
			$("#id_item").val(id);
		
			$("#mi-modal").modal('show');
		  });

		  $("#modal-btn-si").on("click", function(){
			callback(true);
			$("#mi-modal").modal('hide');
		  });
		  
		  $("#modal-btn-no").on("click", function(){
			callback(false);
			$("#mi-modal").modal('hide');
		  });
	};

	modalConfirm(function(confirm){
		if(confirm){
		event.preventDefault();

		var token = $("meta[name='csrf-token']").attr("content");
		var id = $("#id_item").val();
	
			$.ajax(
			{
				url: "/inputlinks/"+id,
				type: 'DELETE',
				data: {
					"id": id,
					"_token": token,
				},
				success: function (){	
					location.reload();
				}
			});
		  }
	});
	