function onSubmit(no){
  			cmp = 'company_name-' + no;
  			console.log(cmp);
  			cmp_name = document.getElementById(cmp).value;
  			console.log(cmp_name);
  			$('#id-' +no).submit();
  		}
  		
function onResearch(research){
	searchText = research;
	searchWord= function(){
	searchResult = [];
	targetText = '';
	hitNum  = '';
	
	if(searchText != ''){
		$('.companyList').each(function(){
			targetText = $(this).text();
		if (targetTet.indexOf(searchText) != -1) {
			searchText.push(targetText);
		}
		
		});
	}	
	
	console.log(searchResult);
	}
}