KindEditor.ready(function(K) {
	window.editor = K.create('#editor_id');
});
$(document).ready(function() {
	$("#selectFileBtn").click(function() {
		$fileField = $('<input type="file" name="thumbs[]"/>');
		$fileField.hide();
		$("#attachList").append($fileField);
		$fileField.trigger("click");
		$fileField.change(function() {
			$path = $(this).val();
			$filename = $path.substring($path.lastIndexOf("\\") + 1);
			$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="javascript:;" title="删除附件">删除</a></div></div>');
			$attachItem.find(".left").html($filename);
			$("#attachList").append($attachItem);
			$("#attachList>.attachItem").find('a').on('click', function() {
				$(this).parents('.attachItem').prev('input').remove();
				$(this).parents('.attachItem').remove();
			});
		});
	});
});