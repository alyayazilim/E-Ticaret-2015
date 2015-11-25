var protokol	= window.location.protocol;
var domain = protokol+"//"+window.location.host;

function nesneOlustur() {
	var nesne;
	var tarayici = navigator.appName;
	if(tarayici == "Microsoft Internet Explorer"){
		nesne = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		nesne = new XMLHttpRequest();
	}
	return nesne;
}

function sKontrol(nesne) {
	var GecerliNesneler = "0123456789.";
	var Numara=true;
	var Karakter;
	for(i=0; i<nesne.value.length && Numara==true; i++) {
		Karakter = nesne.value.charAt(i);
		if(GecerliNesneler.indexOf(Karakter) == -1) {
			nesne.value = nesne.value.substring(0,i);
			break;
		}
	}
	return Numara;
}

function hCD(nesneAdi) {
	document.getElementById(nesneAdi).style.border="1px solid #dcdcdc";
	document.getElementById('kayitSonuc').innerHTML="Bekleniyor";
	document.getElementById('kaydetTus').style.display="inline-block;";
}

function linkSec(nesne) {
	var ustDivId = nesne.parentNode.parentNode;
	if(ustDivId.hasChildNodes()) {
		var child = ustDivId.childNodes;               
		for(var c=0; c < child.length; c++) {
			if(child[c].style) {
				child[c].setAttribute("class", "");
			}
		}
		nesne.parentNode.setAttribute("class", "aktif");
		var url = window.document.URL.toString();
		var urlParca = url.split('/');
		var bilgi = nesne.getAttribute("bilgi");
		var bilgiParca = bilgi.split(', ');
		if(bilgiParca.length == 1) {
			var adres = domain+'/'+urlParca[3]+'/'+urlParca[4]+'/'+bilgiParca[0];
		} else if(bilgiParca.length == 2) {
			var adres = domain+'/'+urlParca[3]+'/'+urlParca[4]+'/'+bilgiParca[0]+'/'+bilgiParca[1];
		} else {
			var adres = domain+'/'+urlParca[3]+'/'+urlParca[4]+'/'+bilgiParca[0]+'/'+bilgiParca[1]+'/'+bilgiParca[2];
		}
		window.history.pushState("asd", "Title", adres);
	}
}

function geriDon() {
	window.history.back();
}

function yonetimKategoriGoster(kategoriNo, divAdi) {
	document.getElementById('yonetimUrunler').innerHTML="";
	var istek =  nesneOlustur();
	var islemDosyasi = domain+"/ajax_istekleri/alt_kategoriler";
	var veri = 'kategori_no='+kategoriNo;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById(divAdi).innerHTML=istek.responseText;
		}
	}
}

function yonetimUrunGoster(kategoriNo, altKategoriNo, divAdi) {
	var istek =  nesneOlustur();
	var islemDosyasi = domain+"/ajax_istekleri/urunler";
	var veri = 'kategori_no='+kategoriNo+'&alt_kategori_no='+altKategoriNo;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById(divAdi).innerHTML=istek.responseText;
		}
	}
}

function kategoriEkle() {
	var istek =  nesneOlustur();
	var islemDosyasi = domain+"/ajax_istekleri/ana_kategori_ekle";
	var veri = 'kategori_no=0';
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById('yonetimUrunDetay').innerHTML=istek.responseText;
		}
	}
}

function altKategoriEkle(kategoriNo) {
	var istek =  nesneOlustur();
	var islemDosyasi = domain+"/ajax_istekleri/ana_kategori_ekle";
	var veri = 'kategori_no='+kategoriNo;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById('yonetimUrunDetay').innerHTML=istek.responseText;
		}
	}
}

function yonetimUrunDetay(kategoriNo, urunNo, divAdi) {
	var istek =  nesneOlustur();
	var islemDosyasi = domain+"/ajax_istekleri/urun_detay";
	var veri = 'kategori_no='+kategoriNo+'&urun_no='+urunNo;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById(divAdi).innerHTML=istek.responseText;
		}
	}
}

function urunEkle(kategoriNo) {
	var istek =  nesneOlustur();
	var islemDosyasi = domain+"/ajax_istekleri/urun_ekle";
	var veri = 'kategori_no='+kategoriNo;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById('yonetimUrunDetay').innerHTML=istek.responseText;
		}
	}
}

function seoOlustur(kategoriAdi) {
	var tKatAdi			= kategoriAdi.trim();
	var istek			=  nesneOlustur();
	var islemDosyasi	= domain+"/ajax_istekleri/seo_hazirla";
	var veri				= 'kategori_adi='+tKatAdi;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById('sefLink').value=istek.responseText;
			document.getElementById('title').value=kategoriAdi;
			document.getElementById('description').value=kategoriAdi;
			document.getElementById('keys').value=kategoriAdi;
		}
	}
}

function kategoriMukerrerKontrol(kategoriAdi) {
	var tKatAdi			= kategoriAdi.trim();
	var istek 			= nesneOlustur();
	var islemDosyasi	= domain+"/ajax_istekleri/mukerrer_kategori_kontrol";
	var veri				= 'kategori_adi='+tKatAdi;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById('kayitSonuc').style.display="inline-block";
			if(istek.responseText == 1) {
				document.getElementById('kaydetTus').style.display="none";
				document.getElementById('kayitSonuc').innerHTML="Bu Kategori Daha Önceden Eklenmiş.";
			}
		}
	}
}

function urunMukerrerKontrol(urunAdi, urunNo) {
	var tUrunAdi		= urunAdi.trim();
	var istek 			= nesneOlustur();
	var islemDosyasi	= domain+"/ajax_istekleri/mukerrer_urun_kontrol";
	var veri				= 'urun_adi='+tUrunAdi+'&urun_no='+urunNo;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById('kayitSonuc').style.display="inline-block";
			if(istek.responseText == 1) {
				document.getElementById('kaydetTus').style.display="none";
				document.getElementById('kayitSonuc').innerHTML="Bu Ürün Daha Önceden Eklenmiş.";
			} else {
				document.getElementById('kaydetTus').style.display="inline-block";
			}
		}
	}
}

function kategoriKaydetKontrol() {
	var mesajDivi		= document.getElementById('kayitSonuc');
	mesajDivi.style.display="inline-block";
	var katAdi			= document.getElementById('katAdi');
	var tKatAdi			= katAdi.value.trim();
	if(tKatAdi.length < 3) {
		mesajDivi.innerHTML="Kategori Adı En az 3 Karakter Olmalıdır !!!";
		katAdi.style.border="1px solid #F00";
		katAdi.focus();
		return false;
	}
	var sefLink			= document.getElementById('sefLink');
	var tSefLink		= sefLink.value.trim();
	if(tSefLink.length < 3) {
		mesajDivi.innerHTML="Seflink En az 3 Karakter Olmalıdır !!!";
		sefLink.style.border="1px solid #F00";
		sefLink.focus();
		return false;
	}
	var title			= document.getElementById('title');
	var tTitle			= title.value.trim();
	if(tTitle.length < 3) {
		mesajDivi.innerHTML="Title En az 3 Karakter Olmalıdır !!!";
		title.style.border="1px solid #F00";
		title.focus();
		return false;
	}
	var description	= document.getElementById('description');
	var tDescription	= description.value.trim();
	if(tDescription.length < 3) {
		mesajDivi.innerHTML="Description En az 3 Karakter Olmalıdır !!!";
		description.style.border="1px solid #F00";
		description.focus();
		return false;
	}
	var keys				= document.getElementById('keys');
	var tKeys			= keys.value.trim();
	if(tKeys.length < 3) {
		mesajDivi.innerHTML="Keywords En az 3 Karakter Olmalıdır !!!";
		keys.style.border="1px solid #F00";
		keys.focus();
		return false;
	}
	var resim = document.getElementById('resim');
	console.log(resim.value());
	if(resim.value()=="") {
		alert('Resim Seçmelisiniz.');
		return false;
	}
}

function dosyaBoyutu(nesneId) {
	if(window.ActiveXObject) {
		var dosyaObje		= new ActiveXObject("Scripting.FileSystemObject");
		var dosyaAdresi	= document.getElementById(nesneId).value;
		var dosyaAdi		= dosyaObje.getFile(dosyaAdresi);
		var dosyaBoyut		= dosyaAdi.size;
	} else {
		var dosyaBoyut		= document.getElementById(nesneId).files[0].size;
	}
	var boyut				= Math.floor(Math.round(dosyaBoyut*100)/100000);
	if(boyut >= 3072) {
		alert("Dosya Boyutu EN FAZLA 3 MB OLMALIDIR!!!")+boyut;
		document.getElementById(nesneId).value="";

	}
}

function kategoriDuzenle(kategoriNo) {
	var istek =  nesneOlustur();
	var islemDosyasi = domain+"/ajax_istekleri/kategori_duzenle";
	var veri = 'kategori_no='+kategoriNo;
	istek.open('POST', islemDosyasi, true);
	istek.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	istek.send(veri);
	istek.onreadystatechange = function() {
		if(istek.readyState == 4) {
			document.getElementById('yonetimUrunDetay').innerHTML=istek.responseText;
		}
	}
}