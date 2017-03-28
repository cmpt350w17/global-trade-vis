function get_max(data) {
	var maxVal = 0;
	var maxCom;
	var tempCom;
	var tempVal;
	for (var i = 0; i < data.length; i++) {
		if (data[i].Export > data[i].Import) {
			tempVal = data[i].Export;
			tempCom = "Export";
		} else {
			tempVal = data[i].Import;
			tempCom = "Import";
		}
		if (tempVal > maxVal) {
			maxVal = tempVal;
			maxCom = tempCom;
		}
	}
	//console.log(maxCom + " " + maxVal);
	return maxCom;
}
