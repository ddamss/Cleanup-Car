function checkboxLimit() {
	var checkBoxGroup1 = document.forms['form_1']['vehiculeName[]'];		
	var checkBoxGroup2 = document.forms['form_1']['cleanerName[]'];		
	
	var limit = 1;
	for (var i = 0; i < checkBoxGroup1.length; i++) {
		checkBoxGroup1[i].onclick = function() {
			var checkedcount = 0;
			for (var i = 0; i < checkBoxGroup1.length; i++) {
				checkedcount += (checkBoxGroup1[i].checked) ? 1 : 0;
			}
			if (checkedcount > limit) {
				console.log("YOUUU1 can select maximum of " + limit + " checkboxes.");
				alert("You can select maximum of " + limit + " checkboxes.");						
				this.checked = false;
			}
		}

	}

	for (var i = 0; i < checkBoxGroup2.length; i++) {
		checkBoxGroup2[i].onclick = function() {
			var checkedcount = 0;
			for (var i = 0; i < checkBoxGroup2.length; i++) {
				checkedcount += (checkBoxGroup2[i].checked) ? 1 : 0;
			}
			if (checkedcount > limit) {
				console.log("YOUUU2 can select maximum of " + limit + " checkboxes.");
				alert("You can select maximum of " + limit + " checkboxes.");						
				this.checked = false;
			}
		}

	}
}