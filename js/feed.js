window.onload = pageLoad;
var jdata;
function pageLoad() {
	document.getElementById('postbutton').onclick = getData;
	readJson();
}
function getData() {
	//  homework
	var msg = document.getElementById("textmsg").value;
	writeJson(msg);
}
function readJson(){
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "js/postDB.json")
	xhr.onload = function(){
		jdata = JSON.parse(xhr.responseText);
		showPost(JSON.parse(xhr.responseText));
	}
	xhr.onerror = function(){alert('Error to read data')}
	xhr.send();
// complete this function
// อ่าน post ที่เคยเขียนไว้ ใน file ที่ชื่อว่า postDB.json และทำการ show post ทั้งหมดที่มีใน file
}
function writeJson(msg) {
	var xhr = new XMLHttpRequest();
	//Keep new user
	var getUser = document.getElementById('nameUser').textContent;
	//create obj file
	var datas = {
		createNew:{
			user :  getUser,
			message : msg
		}
	}
	//plus length array data
	var addLengthArr = Object.keys(jdata).length + 1;
			//create new post data name new post
			var createNew = "newPost" + addLengthArr;

			datas[createNew] = datas["createNew"];
			//clear data when create finished
			delete datas["createNew"];
			//assign obj to file obj data 
			var data = Object.assign(jdata, datas);
			var jsonData = JSON.stringify(data);
			xhr.open("POST", "./js/writeJson.php?data=" + jsonData)
			xhr.onload = () =>{
				window.location.href="http://localhost/assignment10/feed.php";
				showPost(JSON.parse(http.responseText))
			}
			xhr.onerror = () => console.log("Error")
			xhr.send()
	//add code here 
	//homework
	//ส่งข้อความที่เพิ่งพิมพ์และข้อความเก่าเข้ามาเพื่อทำการบันทึกทับใน 
	//postDB.json โดย AJAX ทำการส่ง json string ไปให้ writeJson.php 
	//ถ้าทำสำเร็จจะแสดง post ข้อความ โดยใช้ showPost function
}
function showPost(data){
	var keys = Object.keys(data);
	var divTag = document.getElementById("feed-container");
	for (var i = 0; i < keys.length; i++) {
		var temp = document.createElement("div");
		temp.className = "newsfeed";
		divTag.appendChild(temp);
		var temp1 = document.createElement("div");
		temp1.className = "postmsg";
		temp1.innerHTML = data[keys[i]]["message"];
		temp.appendChild(temp1);
		var temp1 = document.createElement("div");
		temp1.className = "postuser";
		temp1.innerHTML = "Post by: "+data[keys[i]]["user"];
		temp.appendChild(temp1);

	}
}