var ft_list;
var cookie = [];

//load
window.onload = function () {
	document.querySelector("#new").addEventListener("click", newTodo);
	ft_list = document.querySelector("#ft_list");
	var test = document.cookie;
	if (test) {
		cookie = JSON.parse(test);
		cookie.forEach(function(x){ addTodo(x); });
	}
};
window.onunload = function ()
{
	var valeur = ft_list.children;
	var nCookie = [];
	for (var i=0;i<valeur.length;i++)
		newCookie.unshift(valeur[i].innerHTML);
	document.cookie = JSON.stringify(nCookie);
};
//function
function newTodo()
{
	var valeur = prompt("Ajouter une tâche.", '');
	if (valeur !== '' && valeur != null)
		addTodo(valeur);
}
function addTodo(valeur)
{
	var div = document.createElement("div");
	div.innerHTML = valeur;
	div.addEventListener("click", deleteTodo);
	ft_list.insertBefore(div, ft_list.firstChild);
}
function deleteTodo()
{
	if (confirm("Supprimer cette tâche ?"))
		this.parentElement.removeChild(this);
}
