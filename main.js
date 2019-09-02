
	function search()
	{   
		var research_title = document.getElementById('recherche_titre');
		console.log(research_title);
		var tr = document.querySelectorAll('#elements_liste tr');
		console.log(tr);
		var text_research = research_title.value.toLowerCase();
		console.log(text_research);
		
		tr.forEach(function(category)
		{	
			var tr_text = category.textContent.toLowerCase();
			console.log(tr_text);
			/*var tr_titre = document.getElementById('titre');
			console.log(tr_titre);
			var trTitre_text = tr_titre.textContent.toLowerCase();
			console.log(trTitre_text);*/

			if(tr_text.includes(text_research) == false)
			{
				category.classList.toggle('hide',true);

			}
			else
			{
				category.classList.toggle('hide',false);
			}
			
		});		
	}
	search();
	






