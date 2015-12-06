
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

/* js时间戳生成时间函数 */
function getDate(time){
	return new Date(parseInt(time)*1000).toLocaleString();
}