(function(doc, win) {
	var docEl = doc.documentElement,
		resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
		recalc = function() {
			var clientWidth = docEl.clientWidth;
			if (!clientWidth) return;
			if (clientWidth >= 640) {
				docEl.style.fontSize = '100px';
			} else {
				docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
			}
		};

	if (!doc.addEventListener) return;
	win.addEventListener(resizeEvt, recalc, false);
	doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);

$(document).ready(function() {
	var UFlag = 0;
	var PFlag = 0;
	var VFlag = 0;
	// 用户名验证
	var UDiv = $("#UserNameDiv");
	var UInput = $("#UserName");
	var UTip = $("#UserNameTip");
	Verify(UDiv, UInput, UTip, UFlag);
	// 密码验证
	var PDiv = $("#PasswordDiv");
	var PInput = $("#Password");
	var PTip = $("#PasswordTip");
	Verify(PDiv, PInput, PTip, PFlag);
	// 验证码验证
	var VDiv = $("#VerifyDiv");
	var VInput = $("#Verify");
	var VTip = $("#VerifyTip");
	Verify(VDiv, VInput, VTip, VFlag);

	// 返回表单是否正确填写
	function dosubmit() {
		console.log(UFlag+PFlag+VFlag);
		if (UFlag && PFlag && VFlag) {
			return false;
		}
		else {
			alert("表单不能为空！");
			return false;
		}
	}

	// 表单验证
	function Verify(Div, Input, Tip, Flag) {
		Input.blur(function() {
			if (this.value == "") {
				Div.attr("class", "form-group has-error has-feedback");
				Tip.attr("class", "glyphicon glyphicon-remove form-control-feedback");
				Flag = 0;
				console.log(Div+Flag);
			} else {
				Div.attr("class", "form-group has-success has-feedback");
				Tip.attr("class", "glyphicon glyphicon-ok form-control-feedback");
				Flag = 1;
				console.log(Div+Flag);
			}
		});
	}
});