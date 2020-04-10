<script>
/**
 * @author Gabriel Gonzalez gabrielgonzalez1802@gmail.com
 * Document ready for index.php
 */
$(document).ready(function() {
    LoadSelect2Script(DemoSelect2);
    load(1);
    loadPost(1);
    $("#input-21f").rating({
        starCaptions: function (val) {
            if (val < 3) {
                return val;
            } else {
                return 'high';
            }
        },
        starCaptionClasses: function (val) {
            if (val < 3) {
                return 'label label-danger';
            } else {
                return 'label label-success';
            }
        },
        hoverOnClear: false
    });

    $('#addCategoryBlog').bootstrapValidator({
        message: 'El valor no es valido',
          feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
           category: {
                   validators: {
                       notEmpty: {
                           message: 'La categor\u00EDa es requerida'
                       }
                   }
               }
          }
     });
    
    $('#addBlog').bootstrapValidator({
        message: 'El valor no es valido',
          feedbackIcons: {
//               valid: 'glyphicon glyphicon-ok',
//               invalid: 'glyphicon glyphicon-remove',
//               validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
        	title: {
                   validators: {
                       notEmpty: {
                           message: 'El t\u00EDtulo es requerido'
                       }
                   }
            },
            description: {
                  validators: {
                           notEmpty: {
                             message: 'La descripci\u00F3n es requerida'
                       }
               		}
              },
              contenido: {
                       validators: {
                           notEmpty: {
                               message: 'El contenido es requerido'
                           }
                       }
                },
              multiCategory: {
            	  validators: {
                      notEmpty: {
                          message: 'La/s categor\u00EDa/s es/son requerida/s'
                      }
                  }
              }
          }
     });
    
    $('#updateBlog').bootstrapValidator({
        message: 'El valor no es valido',
          feedbackIcons: {
//               valid: 'glyphicon glyphicon-ok',
//               invalid: 'glyphicon glyphicon-remove',
//               validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
        	title: {
                   validators: {
                       notEmpty: {
                           message: 'El t\u00EDtulo es requerido'
                       }
                   }
            },
            description: {
                  validators: {
                           notEmpty: {
                             message: 'La descripci\u00F3n es requerida'
                       }
               		}
              }
          }
     });
    
     

  
   $('#spacializations').bootstrapValidator({
         message: 'El valor no es valido',
           feedbackIcons: {
               valid: 'glyphicon glyphicon-ok',
               invalid: 'glyphicon glyphicon-remove',
               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
               id_role: {
                   validators: {
                       notEmpty: {
                           message: 'El rol es requerido'
                       }
                   }
               },
               rol: {
                   validators: {
                       notEmpty: {
                           message: 'El rol es requerido'
                       }
                   }
               },
                speciality: {
                    message: 'La especialidad es incorrecta',
                    validators: {
                        notEmpty: {
                            message: 'La especialidad es requerida'
                        }
                    }
                }
           }
     });
   

    var table = $('#myTable').DataTable( {
      responsive: true,
      "language": {
            "paginate": {
              "first": "Primera p\u00E1gina",
              "last": "\u00DAltima p\u00E1gina",
              "previous": " << Anterior",
              "next": "Siguiente >>"
          },
            "search": "Buscar ",
            "searchPlaceholder": "Buscar registro",
              "lengthMenu": "mostrar _MENU_ registros",
              "zeroRecords": "No se encontraron registros",
              "info": "mostrando p\u00E1gina _PAGE_ de _PAGES_",
              "infoEmpty": "0 registros",
              "infoFiltered": "(filtrado de _MAX_ registros totales)"
          },
          "pagingType": "full_numbers"
    } );

    var table2 = $('#myTableRol').DataTable( {
        responsive: true,
        "lengthMenu": [10, 15, 20, 25 ],
        "language": {
              "paginate": {
                "first": "Primera p\u00E1gina",
                "last": "\u00DAltima p\u00E1gina",
                "previous": " <<",
                "next": ">>"
            },
              "search": "Buscar ",
              "searchPlaceholder": "Buscar registro",
                "lengthMenu": "mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron registros",
                "info": "mostrando p\u00E1gina _PAGE_ de _PAGES_",
                "infoEmpty": "0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)"
            }
      } );

} );

//Run timepicker
function DemoTimePicker(){
  $.timepicker.regional['es'] = {
				timeOnlyTitle: 'Elegir una hora',
				timeText: 'Hora',
				hourText: 'Horas',
				minuteText: 'Minutos',
				secondText: 'Segundos',
				millisecText: 'Milisegundos',
				timezoneText: 'Huso horario',
				currentText: 'Ahora',
				closeText: 'Cerrar',
				timeFormat: 'HH:mm',
				amNames: ['a.m.', 'AM', 'A'],
				pmNames: ['p.m.', 'PM', 'P'],
				isRTL: false
			};
  $.timepicker.setDefaults($.timepicker.regional['es']);
  $('#input_time').timepicker({setDate: new Date()});
  $('#input_time2').timepicker({setDate: new Date()});
  $('#startEvent').datetimepicker();
  $('#endEvent').datetimepicker();
  $('#updateEndEvent').datetimepicker();
  $('#updateStartEvent').datetimepicker();
}
$('.tool').tooltip();
// Initialize datepicker
$('#input_date').datepicker({setDate: new Date()});
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Anterior',
 nextText: 'Siguiente >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
 dayNamesShort: ['Dom','Lun','Mar','Mier','Juv','Vie','Sab'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sab'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);


 $("#category").change(function(event){
	 var category = $("#category").val();
	 if(category == "1"){
		 $("#stock").prop('disabled', false).change();
		 $("#divStock").show();
	 }else{
		 $("#stock").prop('disabled', 'disabled').change();
		 $("#divStock").hide();
     }
 });


function load(page){
  var query=$("#q").val();
  var per_page=10;
  var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
  $("#loader").fadeIn('slow');
  $.ajax({
    url:'ajax/listDoctorAjax.php',
    data: parametros,
    beforeSend: function(objeto){
    $("#loader").html("<div class='loading'><br><br><br><img src='img/loading.gif' width='40px' height='40px'/><br/></div>");
    },
    success:function(data){
      $(".outer_div").html(data).fadeIn('slow');
      $("#loader").html("");
    }
  })
}

function loadPost(page,cat=null){
	if(cat!=null){
		var query=cat;
	}else{
		var query=$("#buscarPost").val();
		
	}
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page,'cat':cat};
	$("#loaderPost").fadeIn('slow');
	$.ajax({
		url:'ajax/listPostAjax.php',
		data: parametros,
		 beforeSend: function(objeto){
		$("#loaderPost").html("<div class='loading'><br><br><br><img src='img/loading.gif' width='40px' height='40px'/><br/></div>");
	  },
		success:function(data){
			$(".outer_divPost").html(data).fadeIn('slow');
			$("#loaderPost").html("");
		}
	})
}

$("#newArt").click(function(e){
	newArt(e);
});

$("ul.lkdlk li a").click(function(e)
	{
		    e.preventDefault(); /* Evitamos el # en la barra de direcciones */
		    var voto=$(this).data("voto"); /* Obtenemos el resultado del voto: like o dislike */	    
		    var objeto=$(this).closest("li").find(".count"); /* Obtenemos el elemento para cambiar el valor una vez realizado el voto */ 
		    if (voto && objeto) votar(voto,1,objeto); /* Votamos: en este tipo, el valor siempre será +1 */
	});

 $("#input_date").keyup(function(event){
	 var fecha = $("#input_date").val();
	 var date = new Date();
	 var yyyy = date.getFullYear().toString();
	 var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
	 var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
     var fechaActual = moment(event.start).format('DD/MM/YYYY');
	 if(fecha!=""){
		 if(fecha<fechaActual){
			 $("#stateDateInvoice").removeClass("has-success").addClass("has-error");
		     $("#fechaInvoice").html("La fecha de la factura no puede ser menor a la fecha actual");
		 }else{
			 $("#stateDateInvoice").removeClass("has-error").addClass("has-success");
			 $("#fechaInvoice").html("");
		 }
	 }else{
		 $("#stateDateInvoice").removeClass("has-success").addClass("has-error");
	     $("#fechaInvoice").html("Ingrese la fecha de la factura");	
	     
	 }
 });

 $("#input_date").change(function(event){
	 var fecha = $("#input_date").val();
	 var date = new Date();
	 var yyyy = date.getFullYear().toString();
	 var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
	 var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
     var fechaActual = moment(event.start).format('DD/MM/YYYY');
	 if(fecha!=""){
		 if(fecha<fechaActual){
			 $("#stateDateInvoice").removeClass("has-success").addClass("has-error");
		     $("#fechaInvoice").html("La fecha de la factura no puede ser menor a la fecha actual");
		 }else{
			 $("#stateDateInvoice").removeClass("has-error").addClass("has-success");
			 $("#fechaInvoice").html("");
		 }
	 }else{
		 $("#stateDateInvoice").removeClass("has-success").addClass("has-error");
	     $("#fechaInvoice").html("Ingrese la fecha de la factura");	
	 }
 });

//modal borrar general
 function confirmDelete(id,href){
//  	alert("recibi: "+href);
 	const swalWithBootstrapButtons = Swal.mixin({
 		  customClass: {
 		    confirmButton: 'btn btn-success',
 		    cancelButton: 'btn btn-danger'
 		  },
 		  buttonsStyling: false,
 		})

 		swalWithBootstrapButtons.fire({
 		  title: 'Esta seguro?',
 		  text: "Se proceder\u00E1 a borrar el registro!",
 		  type: 'warning',
 		  showCancelButton: true,
 		  confirmButtonText: 'Si, borrrar!',
 		  cancelButtonText: 'No, cancelar!',
 		  reverseButtons: true
 		}).then((result) => {
 		  if (result.value) {
 		    swalWithBootstrapButtons.fire(
 		      'Entendido!',
 		      'Se proceder\u00E1 a borrar el registro.',
 		      'success'
 		    )
 		    setTimeout(function(){ location.href=href }, 1500);
 		  } else if (
 		    // Read more about handling dismissals
 		    result.dismiss === Swal.DismissReason.cancel
 		  ) {
 		    swalWithBootstrapButtons.fire(
 		      'Cancelado',
 		      'El registro esta a salvo :)',
 		      'error'
 		    )
 		  }
 		})
 }

 tinymce.init({
 	/* replace textarea having class .tinymce with tinymce editor */
 	selector: "#wysiwig_simple",
 	language : 'es',
 	/* theme of the editor */
 	theme: "modern",
 	skin: "lightgray",
 	
 	/* width and height of the editor */
 	width: "100%",
 	height: 300,
 	
 	/* display statusbar */
 	statubar: true,
 	
 	/* plugin */
 	plugins: [
 		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
 		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
 		"save table contextmenu directionality emoticons template paste textcolor"
 	],

 	/* toolbar */
 	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
 	
 	/* style */
 	style_formats: [
 		{title: "Headers", items: [
 			{title: "Header 1", format: "h1"},
 			{title: "Header 2", format: "h2"},
 			{title: "Header 3", format: "h3"},
 			{title: "Header 4", format: "h4"},
 			{title: "Header 5", format: "h5"},
 			{title: "Header 6", format: "h6"}
 		]},
 		{title: "Inline", items: [
 			{title: "Bold", icon: "bold", format: "bold"},
 			{title: "Italic", icon: "italic", format: "italic"},
 			{title: "Underline", icon: "underline", format: "underline"},
 			{title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
 			{title: "Superscript", icon: "superscript", format: "superscript"},
 			{title: "Subscript", icon: "subscript", format: "subscript"},
 			{title: "Code", icon: "code", format: "code"}
 		]},
 		{title: "Blocks", items: [
 			{title: "Paragraph", format: "p"},
 			{title: "Blockquote", format: "blockquote"},
 			{title: "Div", format: "div"},
 			{title: "Pre", format: "pre"}
 		]},
 		{title: "Alignment", items: [
 			{title: "Left", icon: "alignleft", format: "alignleft"},
 			{title: "Center", icon: "aligncenter", format: "aligncenter"},
 			{title: "Right", icon: "alignright", format: "alignright"},
 			{title: "Justify", icon: "alignjustify", format: "alignjustify"}
 		]}
 	]
 });
</script>