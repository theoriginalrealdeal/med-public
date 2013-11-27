var med = function () {

	this.validate = function (x) {

		if (x == "login") {

			var u = document.getElementById("username");
			var p = document.getElementById("password");
			var v = true;
			if (u.value.length < 3) {

				this.showError(u,"Your username is too short!");
				v = false;

				}

			if (p.value.length < 3) {

				this.showError(p,"Your password is too short!");
				v = false;

				}

			return v;

			}

		}

	this.showError = function (e,s) {

		var c = this.getPosition(e);
		var t = ((c.bottom-c.height)+document.body.scrollTop)+"px";
		var l = (c.right+10)+"px";
		var id = "id_"+Math.floor(Math.random()*1000000);
		var x = document.createElement("div");
		x.setAttribute("id",id);
		x.className = "help_tip";
		x.innerHTML = s;
		x.style.left = l;
		x.style.top = t;
		document.body.appendChild(x);
		setTimeout("document.getElementById('"+id+"').className='help_tip help_tip_out';",3000);
		setTimeout("MED.clearError('"+id+"');",5000);

		}

	this.clearError = function(id) {

		if (document.getElementById(id)) {

			var e = document.getElementById(id);
			e.parentNode.removeChild(e);

			}

		}

	this.getPosition = function (e) {

		return e.getBoundingClientRect();

		}

	this.load = function () {

		}

	this.bind = function (s,a,f,b) {

		b = b?b:false;
		if (document.addEventListener) s.addEventListener(a,f,b);
		else if (document.attachEvent) s.attachEvent("on"+a,f);
		else {

			var o = (typeof s["on"+a] === "function")?s["on"+a]:null;
			s["on"+a] = function () {

				if (o) o();
				f();

				}

			}

		}

	this.ready = function (f) {

		if (document.addEventListener) this.bind(document,"DOMContentLoaded",f);
		else this.bind(window,"load",f);

		}

	this.focus = function (e) {

		if (document.getElementById(e)) document.getElementById(e).focus();
		else console.log("Can't find "+e);

		}

	}

var MED = new med();