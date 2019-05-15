window.onload = function() {

}

function preview(file) { //预览图片得到图片base64
	var prevDiv = document.getElementById('preview');
	prevDiv.style.display = "block";
	if (file.files && file.files[0]) {
		var reader = new FileReader();
		reader.onload = function(evt) {
			prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
		}
		reader.readAsDataURL(file.files[0]);
	}
}