/**
 * @author Gabriel Gonzalez gabrielgonzalez1802@gmail.com
 * Document ready for index.php
 */
$(document).ready(function() {
	SetMinBlockHeight($('#calendar'));
	// Create Calendar
	DrawFullCalendar();
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		defaultDate: Date(),
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		eventClick: function(event) {
			
			$('#visualizar #id').text(event.id);
			$('#visualizar #title').text(event.title);
			$('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
			$('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
			$('#visualizar').modal('show');
			return false;

		},
		
		selectable: true,
		selectHelper: true,
		select: function(start, end){
			$('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
			$('#cadastrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
			$('#cadastrar').modal('show');						
		}
	});
	// Load Timepicker plugin
	LoadTimePickerScript(DemoTimePicker);
	LoadSelect2Script(DemoSelect2);
    $('#myTable').DataTable( {
        "language": {
        	"paginate": {
      			"first": "Primera página",
      			"last": "Última página",
      			"previous": " << Anterior",
      			"next": "Siguiente >>"
   		 	},
        	"search": "Buscar ",
        	"searchPlaceholder": "Buscar registro",
            "lengthMenu": "mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron registros",
            "info": "mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
        },
        "pagingType": "full_numbers"
    } );
    $('#myTable2').DataTable( {
        "language": {
        	"paginate": {
      			"first": "Primera página",
      			"last": "Última página",
      			"previous": " << Anterior",
      			"next": "Siguiente >>"
   		 	},
            "lengthMenu": "mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron registros",
            "info": "mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
        },
        "pagingType": "full_numbers",
        responsive: {
            details: false
        },
        "searching": false
    } );    
    $('#clinicHistory').bootstrapValidator({
   	 message: 'El valor no es valido',
        feedbackIcons: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
       	 expedient: {
                 message: 'El expediente es incorrecto',
                 validators: {
                     notEmpty: {
                         message: 'El expediente es requerido'
                     }
                 }
             },
             medical: {
                 message: 'El doctor es incorrecto',
                 validators: {
                     notEmpty: {
                         message: 'El doctor es requerido'
                     }
                 }
             },
             medical: {
                 message: 'El doctor es incorrecto',
                 validators: {
                     notEmpty: {
                         message: 'El doctor es requerido'
                     }
                 }
             },
             record: {
                 message: 'El registro es incorrecto',
                 validators: {
                     notEmpty: {
                         message: 'El registro es requerido'
                     }
                 }
             }
        }
   });
    $('#generateInform').bootstrapValidator({
   	 message: 'El valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	diagnostico: {
                 message: 'El diagnóstico médico es incorrecto',
                 validators: {
                     notEmpty: {
                         message: 'El diagnóstico médico es requerido'
                     }
                 }
             }
        }
   });
    $('#newDoctor').bootstrapValidator({
    	 message: 'El valor no es valido',
         feedbackIcons: {
             valid: 'glyphicon glyphicon-ok',
             invalid: 'glyphicon glyphicon-remove',
             validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
        	 user: {
                  message: 'El usuarion es incorrecto',
                  validators: {
                      notEmpty: {
                          message: 'El usuario es requerido'
                      }
                  }
              },
              dni: {
                  message: 'El dni es incorrecto',
                  validators: {
                      notEmpty: {
                          message: 'El dni es requerido'
                      }
                  }
              }
         }
    });
    $('#updatePassword').bootstrapValidator({
      	 message: 'El valor no es valido',
           feedbackIcons: {
               valid: 'glyphicon glyphicon-ok',
               invalid: 'glyphicon glyphicon-remove',
               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
               password: {
                   validators: {
                       notEmpty: {
                           message: 'La contraseña no puede estar vacía'
                       },
                       identical: {
                           field: 'confirmPassword',
                           message: 'La contraseña y su confirmación no son las mismas'
                       }
                   }
               },
               confirmPassword: {
                   validators: {
                       notEmpty: {
                           message: 'La confirmación de la contraseña no puede estar vacía'
                       },
                       identical: {
                           field: 'password',
                           message: 'La contraseña y su confirmación no son las mismas'
                       }
                   }
               },
               oldPassword: {
                   validators: {
                       notEmpty: {
                           message: 'La contraseña no puede estar vacía'
                       }
                   }
               }
           }
      });
    $('#newEmployee').bootstrapValidator({
      	 message: 'El valor no es valido',
           feedbackIcons: {
               valid: 'glyphicon glyphicon-ok',
               invalid: 'glyphicon glyphicon-remove',
               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
        	   codeEmployee: {
                    message: 'El Código del Empleado es Incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El código del empleado es requerido'
                        }
                    }
                },
                user: {
                    message: 'El usuario es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El usuario es requerido'
                        }
                    }
                }
           }
      });
    $('#clinicalHistory').bootstrapValidator({
      	 message: 'El valor no es valido',
           feedbackIcons: {
//               valid: 'glyphicon glyphicon-ok',
//               invalid: 'glyphicon glyphicon-remove',
//               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
        	   patient: {
                    message: 'El paciente es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El paciente es requerido'
                        }
                    }
                },
                especialidad: {
                    message: 'La especialidad es incorrecta',
                    validators: {
                        notEmpty: {
                            message: 'La especialidad es requerida'
                        }
                    }
                },
                doctor: {
                    message: 'El doctor es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El doctor es requerido'
                        }
                    }
                },
                expedient: {
                    message: 'El expediente es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El expediente es requerido'
                        }
                    }
                }
           }
      });  
      $('#appoiment').bootstrapValidator({
       	 message: 'El valor no es valido',
            feedbackIcons: {
//                valid: 'glyphicon glyphicon-ok',
//                invalid: 'glyphicon glyphicon-remove',
//                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
            	patient: {
                     message: 'El paciente es incorrecto',
                     validators: {
                         notEmpty: {
                             message: 'El paciente es requerido'
                         }
                     }
                 },
                 especialidad: {
                     message: 'La especialidad es incorrecta',
                     validators: {
                         notEmpty: {
                             message: 'La especialidad es requerida'
                         }
                     }
                 },
                 doctor: {
                     message: 'El doctor es incorrecto',
                     validators: {
                         notEmpty: {
                             message: 'El doctor es requerido'
                         }
                     }
                 },
                 fecha: {
                     message: 'La fecha es incorrecta',
                     validators: {
                         notEmpty: {
                             message: 'La fecha es requerida'
                         }
                     }
                 },
                 hora: {
                     message: 'La hora es incorrecta',
                     validators: {
                         notEmpty: {
                             message: 'La hora es requerida'
                         }
                     }
                 },
                 motive: {
                     message: 'El motivo de la cita es incorrecto',
                     validators: {
                         notEmpty: {
                             message: 'El motivo de la cita es requerido'
                         }
                     }
                 },
                 status: {
                     message: 'El estatus de la cita es incorrecto',
                     validators: {
                         notEmpty: {
                             message: 'El status de la cita es requerido'
                         }
                     }
                 }
            }
       });  
    $('#attendanceSheet').bootstrapValidator({
      	 message: 'El valor no es valido',
           feedbackIcons: {
               valid: 'glyphicon glyphicon-ok',
               invalid: 'glyphicon glyphicon-remove',
               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
        	   user: {
                    message: 'El nombre o cédula del empleado es Incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El nombre o cédula del empleado es requerido'
                        }
                    }
                },
                mes: {
                	message: 'El mes es Incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El mes es requerido'
                        }
                    }
                },
                agno: {
                	message: 'El año es Incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El año es requerido'
                        }
                    }
                }
           }
      });
    $('#updateUser').bootstrapValidator({
      	 message: 'El valor no es valido',
           feedbackIcons: {
               valid: 'glyphicon glyphicon-ok',
               invalid: 'glyphicon glyphicon-remove',
               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
        	   user: {
        		    message: 'El Código del Usuario es Incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El usuario es requerido'
                        }
                    }
                },
                rol: {
                	message: 'El rol es Incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El rol es requerido'
                        }
                    }
                },
                status: {
                	message: 'El estatus es Incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El estatus es requerido'
                        }
                    }
                }
           }
      });
    $('#updatePerson').bootstrapValidator({
   	 message: 'El valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	codeEmployee: {
                 message: 'El Código del Empleado es Incorrecto',
                 validators: {
                     notEmpty: {
                         message: 'El código del empleado es requerido'
                     }
                 }
             }
        }
   }); 
    
    $('#patient').bootstrapValidator({
      	 message: 'El valor no es valido',
           feedbackIcons: {
//               valid: 'glyphicon glyphicon-ok',
//               invalid: 'glyphicon glyphicon-remove',
//               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
        	   first_name: {
                    message: 'El primer nombre del paciente es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El primer nombre del paciente es requerido'
                        }
                    }
                },
                first_surname: {
                    message: 'El primer apellido del paciente es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El primer apellido del paciente es requerido'
                        }
                    }
                },
                identification_card: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese la cédula'
                        }
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'La cédula solo puede contener números'
                    }
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione el género'
                        }
                    }
                },
                country: {
                    message: 'El país es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El país es requerido'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese el E-mail'
                        },
                        emailAddress: {
                            message: 'Ingrese un e-mail válido'
                        }
                    }
                },
                blood: {
                   validators: {
                          notEmpty: {
                        	  message: 'El grupo sanguíneo es requerido'
                          }
                   }
                },
                birthdate: {
                    message: 'La fecha de nacimiento es incorrecta',
                    validators: {
                        notEmpty: {
                            message: 'La fecha de nacimiento es requerida'
                        }
                    }
                },
                localNumber: {
                    message: 'El número local es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El teléfono fijo es requerido'
                        },
                        regexp: {
                            regexp: /^\d*$/,
                            message: 'El teléfono fijo solo puede contener números'
                        }
                    }
                },
                telephoneNumber: {
                    message: 'El número celular es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El teléfono movil es requerido'
                        },
                        regexp: {
                            regexp: /^\d*$/,
                            message: 'El teléfono movil solo puede contener números'
                        }
                    }
                },
                direction: {
                    message: 'La dirección es incorrecta',
                    validators: {
                        notEmpty: {
                            message: 'La dirección es requerida'
                        }
                    }
                },
                postalCode: {
                    message: 'El código postal es incorrecto',
                    validators: {
                        notEmpty: {
                            message: 'El código postal es requerido'
                        }
                    }
                }
                
           }
      }); 
    $('#addPresedent').bootstrapValidator({
     	 message: 'El valor no es valido',
          feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
        	  presedent: {
                   validators: {
                       notEmpty: {
                           message: 'El antecedente es requerido'
                       }
                   }
               }
          }
    });
    $('#bloob').bootstrapValidator({
     	 message: 'El valor no es valido',
          feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
        	  bloodType: {
                  validators: {
                      notEmpty: {
                          message: 'El grupo sanguíneo es requerido'
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
    $('#profile').bootstrapValidator({
        message: 'El valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	firstName: {
                 message: 'El nombre ingresado no es correcto',
                 validators: {
                     notEmpty: {
                         message: 'Ingrese el primer nombre'
                     }
                 }
             },
            firstSurname: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el primer apellido'
                    }
                }
            },
            identificationCard: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese la cédula'
                    }
                },
                regexp: {
                    regexp: /^[0-9]+$/,
                    message: 'La cédula solo puede contener números'
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el género'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el país'
                    }
                }
            },
            state: {
               validators: {
                   notEmpty: {
                       message: 'Seleccione el estado'
                   }
               }
            },
            direction: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese la dirección'
                    }
                }
            },
            codeLocal: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el código de area'
                    }
                }
            },
            localNumber: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el número local'
                    }
                }
            },
            codeCelu: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el código de area del célular'
                    }
                }
            },
            telephoneNumber: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el número celular'
                    }
                }
            },
            postalCode: {
                validators: {
                	 notEmpty: {
                         message: 'Ingrese el código postal'
                     }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el E-mail'
                    },
                    emailAddress: {
                        message: 'Ingrese un e-mail válido'
                    }
                }
            },
            blood: {
                validators: {
                	notEmpty: {
                        message: 'Seleccione el Grupo Sanguíneo'
                    }
                }
            },
            birthdate: {
                validators: {
                	notEmpty: {
                        message: 'Ingrese la fecha de nacimiento'
                    }
                }
            }
        }
    });
} );
//Run timepicker
function DemoTimePicker(){
	$('#input_time').timepicker({setDate: new Date()});
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
 //select dependientes appoiment
 $(function(){
		// Lista de especialidades
		$.post( 'dependencies/specializations.php' ).done( function(respuesta)
		{
			$( '#especialidad' ).html( respuesta );
		});
	
		// lista de Doctores	
		$('#especialidad').change(function()
		{
			$('#doctor').val("");
			$('#doctor').change();
		    
			if($("#especialidad").val() !== ""){
			      $('#doctor').prop('disabled', false);
			}else{
				 $('#doctor').val("");
				 $('#doctor').change();
			     $('#doctor').prop('disabled', 'disabled');
			}
			
			var la_especialidad = $(this).val();
			
			// Lista de doctores
			$.post( 'dependencies/doctors.php', { especialidad: la_especialidad} ).done( function( respuesta )
			{
				$( '#doctor' ).html( respuesta );
			});
		});

	});
//Select dependientes pais - estados
	$(function(){
		// Lista de paises
		$.post( 'dependencies/countries.php' ).done( function(respuesta)
		{
			$( '#country' ).html( respuesta );
		});
	
		// lista de estados	
		$('#country').change(function()
		{
			$('#state').val("");
			$('#state').change();
			
			if($("#country").val() !== ""){
			      $('#state').prop('disabled', false);
			}else{
				 $('#state').val("");
				 $('#state').change();
			     $('#state').prop('disabled', 'disabled');
			}
			
			var $el_pais = $(this).val();
			
			$.post( 'dependencies/telephoneCodes.php', { country: $el_pais} ).done( function( respuesta )
			{
				$('#fijo').html( respuesta );
				$('#movil').html( respuesta );
			});
			
			// Lista de doctores
			$.post( 'dependencies/states.php', { country: $el_pais} ).done( function( respuesta )
			{
				$( '#state' ).html( respuesta );
			});
		});
	});
$(function () {
$("#fecha").datepicker();
$("#fechaIngreso").datepicker();
LoadFancyboxScript(DemoGallery);
function DemoGallery(){
 	$('.fancybox').fancybox({
 			openEffect	: 'none',
 			closeEffect	: 'none'
 		});
 }
});