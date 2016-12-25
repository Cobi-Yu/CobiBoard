<h2 class="page_title">게시물 등록</h2>
<form method="post" action="/board/write" id="write_form">
	<input type="hidden" name="parent_id" value="<?=$board_data['parent_id'];?>" >
	<table>
		<tr>
			<td class="category">제목</td>
			<td class="input">
				<input type="text" name="title" size="50" title="제목">
			</td>
		</tr>
		<tr>
			<td class="category">게시자</td>
			<td>
				<input type="text" name="writer" title="작성자">
			</td>
		</tr>
		<tr>
			<td class="category">내용</td>
			<td>
				<textarea rows="10" class="content" name="content" title="본문"></textarea>
			</td>
		</tr>
	</table>

	<div class="bottom-btn">
		<div>비밀번호 : <input type = "password" name="password"></div>
		<button>등록하기</button>
	</div>
</form>