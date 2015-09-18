jQuery(document).ready(function($) {
	var ctx = document.getElementById('russell-wrapper').getContext('2d');
	var al = 0;
	var start = 4.72;
	var cw = ctx.div.width;
	var ch = ctx.div.height;
	var diff;
	function progressSim() {
		diff = (( al / 100 ) * Math.PI*2*10 ).toFixed(2);
		ctx.clearRect(0, 0, cw, ch);
		ctx.lineWidth = 10;
		ctx.fillStyle = '#09F';
		ctx.strokeStyle = "#09F";
		ctx.textAlign = 'center';
		ctx.fillText(al+'%', cw*.5, ch*.5+2, cw);
		ctx.beginPath();
		ctx.arc(35, 35, 30, start, diff/10+start, false);
		ctx.stroke();
		if(al >= 100) {
			clearTimeout(sim);
		}
	}
	al++;
});