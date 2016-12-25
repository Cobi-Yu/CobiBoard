<h2 class="page_title">게시물 목록</h2>
<table>
	<caption>
		<div>총 게시글 : <?=$board_list_data['count']?>건</div>
	</caption>
	<caption align="bottom">
		<div>현재 <?=$board_list_data['page']?> 페이지</div>
		<a href="/board/write_view"><button>글 쓰기</button></a>
	</caption>
	<tr>
		<th>NO.</th>
		<th>제목</th>
		<th>게시자</th>
		<th>조회수</th>
	</tr>
	<?php
	foreach ($board_list_data['list_data'] as $item){
	?>
		<tr>
		    <td><?=$item->depth==0 ? $board_list_data['begin_no']++ : ""?></td>
			<td class="title"><a href="/board/view/<?=$item->board_id?>">
			<?php
				for ($i=0; $i < $item->depth; $i++) {
					echo "--";
				}
				for ($i=0; $i < $item->depth; $i++) {
					echo "RE:";
				}
				echo $item->title;
			?>
			</a></td>
			<td><?=$item->writer?></td>
			<td><?=$item->hit?></td>
		</tr>
	<?php
	}
	?>
</table>

<div class="paging">
	<?php echo $board_list_data['paging'];?>
</div>
