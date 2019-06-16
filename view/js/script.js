$(document).ready(function() {

  $('#modal-cpf').modal('show');

  $('.num1').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '1');
    }
    validate_input();
  });
  $('.num2').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '2');
    }
    validate_input();
  });
  $('.num3').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '3');
    }
    validate_input();
  });
  $('.num4').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '4');
    }
    validate_input();
  });
  $('.num5').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '5');
    }
    validate_input();
  });
  $('.num6').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '6');
    }
    validate_input();
  });
  $('.num7').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '7');
    }
    validate_input();
  });
  $('.num8').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '8');
    }
    validate_input();
  });
  $('.num9').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '9');
    }
    validate_input();
  });
  $('.num0').on('click', function(){
    if(check_input()){
      $('#num_cand').val($('#num_cand').val() + '0');
    }
    validate_input();
  });

  $('.confirma').on('click', function(){
    search_candidate();
    $( "#vote" ).trigger( "click" );
  });

  $('.clear').on('click', function(){
    clear();
  });

  $('#form-vote').submit(function(){
    var dados = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "http://localhost/urna_sistemas_distribuidos/vote",
      data: dados,
      success: function(data)
      {
        console.log(data);
        var response = $.parseJSON(data);
        if(response.message=='Vote was computed'){
          $('.response-alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert">  <strong>Sucesso!</strong> O seu voto foi computado.  <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span>  </button></div>');
          clear();
        }else if(response.message=='Invalid'){
          $('.response-alert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">  <strong>Erro!</strong> Ocorreu um erro ao computar o seu voto.  <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span>  </button></div>');
          clear();
        }
      }
    });
    return false;
  });

  $('#btn-cpf').on('click',function(){
    $('#form-cpf').val($('#user-cpf').val());
  });

  $('#btn-result').on('click', function(){
    election_result();
  });

});

function clear(){
  $(".candidate").fadeOut();
  $(".candidate").fadeIn();
  setTimeout(function(){
    $('#num_cand').val('');
    $("#candidate-name").html('');
    $("#candidate-number").html('');
    $("#candidate-political").html('');
    $("#candidate-img").attr("src","http://localhost/urna_sistemas_distribuidos/view/image/candidato_icon.png");
  }, 400);
}

function check_input(){
  if($('#num_cand').val().length < 2){
    return true;
  }
  return false;
}

function validate_input(){
  if(($('#num_cand').val().length == 2)){
    $(".candidate").fadeOut();
    $(".candidate").fadeIn();
    setTimeout(function(){
      search_candidate();
    }, 400);
  }
}

function search_candidate(){
  var url = 'http://localhost/urna_sistemas_distribuidos/candidate?num=' + $('#num_cand').val();
  $.each(ajax_get(url), function(i, candidate){
    $("#form-id").val(candidate.id);
    $("#candidate-name").html(candidate.name);
    $("#candidate-number").html(candidate.number);
    $("#candidate-political").html(candidate.political_party);
    $("#candidate-img").attr("src","http://localhost/urna_sistemas_distribuidos/view/image/candidates/"+candidate.photo);					
  });
}

function election_result(){
  console.log('alo');
  $('.election-result').html('');
  var url = 'http://localhost/urna_sistemas_distribuidos/results';
  $.each(ajax_get(url), function(i, candidate){
    $('.election-result').append('<div class="row margin"> <div class="col-md-2 my-auto"> <img src="http://localhost/urna_sistemas_distribuidos/view/image/candidates/' + candidate.photo + '" alt="" class="rounded-circle" style="width:100%;"> </div> <div class="col-md-10 my-auto"> <div class="progress my-auto"> <div class="progress-bar" role="progressbar" style="width:'+ candidate.votes*5 + '%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+ candidate.votes + ' Votos</div> </div> </div> </div>');
  });
}

function ajax_get(url){
	var json;
	var staticUrl = url;
	$.ajax({
		type : 'GET',
		url : staticUrl,
		dataType : 'json',
		async: false,
		success: function(data){
			if(data!=null){
				if(!$.isArray(data)){
					newJson = "["+ JSON.stringify(data) + "]";
					json = JSON.parse(newJson);
				}else{
						json = data;
				} 
			}else{
				json = null;
			}
			
		}
	}); 
	return json; 
}


  