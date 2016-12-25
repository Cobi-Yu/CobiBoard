<h2 class="page_title">게시물 수정</h2>
<form method="post" action="/board/update">
	<input type="hidden" name="board_id" value="<?=$board_data->board_id;?>">
	<table>
		<tr>
			<td class="category">제목</td>
			<td class="input">
				<input type="text" name="title" size="50" 
				value="<?=isset($board_data->title) ? $board_data->title : ''?>">
			</td>
		</tr>
		<tr>
			<td class="category">게시자</td>
			<td>
				<input type="text" name="writer" 
				value="<?=isset($board_data->writer) ? $board_data->writer : ''?>">
			</td>
		</tr>
		<tr>
			<td class="category">내용</td>
			<td>
				<textarea rows="10" class="content" name="content"><?=isset($board_data->content) ? $board_data->content : ''?></textarea>
			</td>
		</tr>
	</table>
	
	<div class="bottom-btn">
		<button>수정하기</button>
	</div>
</form>