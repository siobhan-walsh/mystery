

	btndiv = document.getElementById('btndiv');
	
	var footer = document.getElementById('footer');
	
	console.log('footer height is', $(footer).height());
	
	btndiv.style.backgroundColor = '#ff0000';
	
	btndiv.style.position = 'absolute';
	btndiv.style.top = $(footer).height();
	btndiv.style.width = '100%';
	
	
	footer.style.backgroundColor = '#ffccee';