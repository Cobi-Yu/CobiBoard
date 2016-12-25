$('.checkPw').click(function(e){
	e.preventDefault();
	var link = $(this).attr('href');
	$.ajax({
		url:'/board/check_password/'+$('#board_id').val(),
		type :'GET',
        dataType:'json',
        data :{
    		password:$('#password').val()
    	},
        success:function(data){
        	if(data.result){
        		$(location).attr('href',link);
        	}else{
        		alert('비밀번호가 일치하지 않습니다.');
        	}
        },
        error:function(request,status,error){
        	alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
	});
});


$('#write_reply').click(function(e){
	e.preventDefault();
	var reply = {
    		content:$('#reply_input_content').val().replace(/\n/g, "<br>"),
    		writer:$('#reply_input_writer').val()
    	};
	if( ($.trim(reply.content)=="") || ($.trim(reply.content)=="")){
		alert('댓글 작성자, 내용을 입력해주세요.');
	} else{
		var link = $(this).attr('href');
		$.ajax({
			url:'/reply/write/'+$('#board_id').val(),
			type :'POST',
	        dataType:'json',
	        data : reply,
	        success:function(data){
	        	var writer = $('<b>').text(data.writer);
	        	var reg_date = $('<span>').addClass('reg_date').text(" "+data.reg_date);
	        	var content = $('<div>').html(data.content);
	        	var deleteBtn = $('<a>').addClass('delete_reply').attr('value',data.reply_id).text('X');
	        	var td = $('<td>').append(writer).append(reg_date).append(deleteBtn).append(content);
	        	$('#reply_table').append($('<tr>').append(td));
	        	$('#count').text(parseInt($('#count').text())+1);
	        	$('#reply_input_writer').val('');
	        	$('#reply_input_content').val('');
	        },
	        error:function(request,status,error){
	        	console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	        }
		});
	}
});

$(document).on("click",'.delete_reply',function(){
	var element=$(this); 
	$.ajax({
		url:'/reply/delete/'+element.attr('value'),
		type :'POST',
        success:function(data){
        	if(data){
        		element.parent().remove();
        		$('#count').text(parseInt($('#count').text())-1);
        	}
        },
        error:function(request,status,error){
        	console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
	});
});