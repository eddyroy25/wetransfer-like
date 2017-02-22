			var intervalle = setTimeout(skymove, 1000);
			function skymove () {
			document.body.style.backgroundPosition = "-10000px";
			var intervalle2 = setTimeout(skymove2, 1000);
			}
			function skymove2 () {
			document.body.style.backgroundPosition = "-10000px";
			var intervalle3 = setTimeout(skymove, 1000);
			}		