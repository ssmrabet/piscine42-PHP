var ft_list;
var cookie = [];

$(document).ready(function(){
	$('#new').click(newTodo);
	ft_list = $('#ft_list');
	var test = document.cookie;
	if (test) {
		cookie = JSON.parse(test);
		cookie.forEach(function (x){ addTodo(x); });
	}
});
$(window).unload(function(){
	var valeur = ft_list.children();
	var nCookie = [];
	for (var i=0;i<valeur.length;i++)
	nCookie.unshift(valeur[i].innerHTML);
document.cookie = JSON.stringify(nCookie);
})
function newTodo(){
	var valeur = prompt("Ajouter une tâche.", '');
	if (valeur !== '' && valeur !== null)
		addTodo(valeur);
}
function addTodo(valeur){
	ft_list.prepend($('<div>' + valeur + '</div>').click(deleteTodo));
}
function deleteTodo(){
	if (confirm("Supprimer cette tâche ?"))
		this.remove();
}
