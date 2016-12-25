<input type ="hidden" id="board_id" value="<?=$data['board_data']->board_id?>">
<h2 class="page_title">게시물 조회</h2>

<table>
	<tr>
		<td>제목</td>
		<td colspan="5" >
			<?=$data['board_data']->title?>
		</td>
	</tr>
	<tr>
		<td>게시자</td>
		<td>
			<?=$data['board_data']->writer?>
		</td>
		<td>게시일</td>
		<td>
			<?=$data['board_data']->reg_date?>
		</td>
		<td>조회수</td>
		<td>
			<?=$data['board_data']->hit?>
		</td>
	</tr>
	<tr>
		<td>내용</td>
		<td colspan="5">
			<?=$data['board_data']->content?>
		</td>
	</tr>
</table>
<br><br>

<table id="reply_table">
	<caption>
		<div class="reply-count">댓글 <span id="count"><?=count($data['reply_data']);?></span></div>
	</caption>
	<?php 
	foreach ($data['reply_data'] as $item){
	?>
		<tr>
			<td>
				<b><?=$item->writer?></b>
				<span class="reg_date"><?=$item->reg_date?></span>
				<a class="delete_reply" value="<?=$item->reply_id?>">X</a>
				<div>
					<?=$item->content?>
				</div>
			</td>
		</tr>
	<?php 
	}
	?>
</table>

<table class="reply_write_table">
	<tr>
		<td class="reply_writer_td">
			<input type="text" id="reply_input_writer" placeholder="작성자">
		</td>
		<td class="reply_content_td">
			<textarea rows="4" id="reply_input_content" placeholder="댓글내용"></textarea>
		</td>
		<td class="reply_btn">
			<button id="write_reply">댓글<br>등록</button>
		</td>
	</tr>
</table>

<div class="bottom-btn">
	<div>
		비밀번호 : <input id="password" type = "password">
	</div>
	<div class="control_btn">
		<a href="/board/lists"><button>글 목록</button></a>
		<a href="/board/write_view/"><button>새글쓰기</button></a>
		<a href="/board/write_view/<?=$data['board_data']->board_id?>"><button>답글쓰기</button></a>
		<a class="checkPw" href="/board/update_view/<?=$data['board_data']->board_id?>"><button>수정</button></a>
		<a class="checkPw" href="/board/delete/<?=$data['board_data']->board_id?>"><button>삭제</button></a>
	</div>
</div>

