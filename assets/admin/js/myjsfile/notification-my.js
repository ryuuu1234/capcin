function notif_(txt){
	if (txt == 'success') {
		notification("topright","success","fa fa-check-circle vd_green",
		"Success Notification","Data Sukses Tersimpan. Good Job!");
	} else	if(txt == 'error') {
		notification("topright","error","fa fa-exclamation-circle vd_red",
		"Error Notification","Data Error. Ulangi!");
	} else	if(txt == 'info') {
		notification("topright","info","fa fa-info-circle vd_blue",
		"Info Notification","Data updated. Good Job!");	
	}	
}