var xmlHttp;
//判断并启用xmlhttprequest的方法(子方法)
function start_xmlhttprequest() {
	if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	} else if(window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}
}

//获取执行的内容并反映到页面中(子方法)
function change() {
		var response = xmlHttp.responseText;            //获取响应赋值给变量
		document.getElementById('php100').innerHTML = response;		//使用DOM组件将变量的赋值给id为php100的标签
	}

//接收和处理传输数据方法
function ajax_fun(data) {
		start_xmlhttprequest();
		xmlHttp.open("GET","for.php?id="+data,true);		//打开请求，传输内容并获取反馈
		xmlHttp.onreadystatechange = change;		//准备就绪后要执行的方法，change方法获取执行的内容并反映到页面中
		xmlHttp.send(null);
	}