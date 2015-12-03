
function checkEmail(str){
	var reg = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
    return reg.test(str);
}

function checkPwd(pwd){
	var reg = /\w{8,15}/;
	return reg.test(pwd);
}

/* 验证码检查 */
function checkCode(checkcode){
	return /^\d{6}$/.test(checkcode);
}