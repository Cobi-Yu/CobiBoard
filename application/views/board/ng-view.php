
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/asset/css/common.css"/>
<link rel="stylesheet" type="text/css" href="/asset/css/view.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script type="text/javascript" src="https://static.gabia.com/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body data-ng-app="board" data-ng-controller="boardDetail">

	<ul>
		<li><a href="/angular/lists"><h3>YHH's Board</h3></a></li>
	</ul>

<h2 class="page_title">게시물 조회</h2>

<table>
	<tr>
		<td>제목</td>
		<td colspan="5" >
		</td>
	</tr>
	<tr>
		<td>게시자</td>
		<td>
		</td>
		<td>게시일</td>
		<td>
		</td>
		<td>조회수</td>
		<td>
		</td>
	</tr>
	<tr>
		<td>내용</td>
		<td colspan="5">
		</td>
	</tr>
</table>
<br><br>

<table id="reply_table">
	<caption>
		<div class="reply-count">댓글 <span data-ng-bind="boardDetailData.reply_data.length"></span></div>
	</caption>
	<tr data-ng-repeat="replyItem in boardDetailData.reply_data">
		<td>
			<b data-ng-bind="replyItem.writer"></b>
			<span class="reg_date" data-ng-bind="replyItem.reg_date">2016-09-02 04:25:01</span>
			<a class="delete_reply">X</a>
			<div data-ng-bind="replyItem.content"></div>
		</td>
	</tr>
</table>

<table class="reply_write_table">
	<tr>
		<form ng-submit="insertReply(replyData)">
			<td class="reply_writer_td">
				<input type="text" ng-model="replyData.writer" placeholder="작성자">
			</td>
			<td class="reply_content_td">
				<textarea rows="4" ng-model="replyData.content" placeholder="댓글내용"></textarea>
			</td>
			<td class="reply_btn">
				<button type="submit">댓글<br>등록</button>
			</td>
		</form>
	</tr>
</table>

<div class="bottom-btn">
	<div>
		비밀번호 : <input id="password" type = "password">
	</div>
	<div class="control_btn">
		<a href="/angular/lists"><button>글 목록</button></a>
		<a href="/angular/write_view/"><button>새글쓰기</button></a>
		<a href="/angular/write_view/16"><button>답글쓰기</button></a>
		<a class="checkPw" href="/angular/update_view/16"><button>수정</button></a>
		<a class="checkPw" href="/angular/delete/16"><button>삭제</button></a>
	</div>
</div>

</body>
<script src="/asset/js/app.js"></script>
<script src="/asset/js/controller.js"></script>
<script src="/asset/js/directive.js"></script>
<script src="/asset/js/service.js"></script>
</html>
