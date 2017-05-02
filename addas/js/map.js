function initialize() {

	var image = '/lp/tsushin/wp/wp-content/themes/addas/img/icon-map.png'; //マーカーアイコン画像URL
	// var iconSize = new google.maps.Size(70, 70);
	// var icon = new google.maps.MarkerImage(image, iconSize);

	var latlng1 = new google.maps.LatLng(31.581623, 130.544872);
	var opts1 = {
		zoom: 17,
		center: latlng1,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: [{
			stylers: [
				{hue: '#000000'},
				{saturation: -100}
			]
		}]
	};

	var latlng2 = new google.maps.LatLng(31.679561, 130.557553);
	var opts2 = {
		zoom: 17,
		center: latlng2,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: [{
			stylers: [
				{hue: '#000000'},
				{saturation: -100}
			]
		}]
	};



	var map1 = new google.maps.Map(document.getElementById("google-map__tyuou"), opts1);
	var marker1 = new google.maps.Marker({
		position: latlng1, //マーカーの位置
		map: map1, //表示する地図
		icon: {
			url: image
			// scaledSize : iconSize
		}, //アイコン画像をセット
		title: "鹿児島中央教室" //ロールオーバー テキスト
	});
	var map2 = new google.maps.Map(document.getElementById("google-map__yoshida"), opts2);
	var marker2 = new google.maps.Marker({
		position: latlng2, //マーカーの位置
		map: map2, //表示する地図
		icon: {
			url: image
			// scaledSize : iconSize
		}, //アイコン画像をセット
		title: "吉田教室" //ロールオーバー テキスト
	});



}
google.maps.event.addDomListener(window, 'load', initialize);

