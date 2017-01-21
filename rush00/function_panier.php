<?php
function makePanier()
{
	if (!isset($_SESSION['panier']))
	{
		$_SESSION['panier']=array();
		$_SESSION['panier']['refProduit'];
		$_SESSION['panier']['qProduit'];
		$_SESSION['panier']['prixProduit'];
		$_SESSION['panier']['lock'] = false;
	}
	echo 'test';
	return true;
}
function islock()
{
	if (isset($_SESSION['panier']) && $_SESSION['panier']['lock'])
		return true;
	else
		return false;
}
function addArticle($refProduit, $qProduit,$prixProduit)
{
	if (makePanier() && !islock())
	{
		$posProduit = array_search($refProduit,  $_SESSION['panier']['refProduit']);
		if ($posProduit !== FALSE)
			$_SESSION['panier']['qProduit'][$posProduit] += $qProduit;
		else {
			array_push( $_SESSION['panier']['refProduit'],$refProduit);
			array_push( $_SESSION['panier']['qProduit'],$qProduit);
			array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
		}
	}
	else {
		echo "Un probleme est survenu veuillez reessayer plus tard.";
	}
}
function delArticle($refproduit)
{
	if (makePanier() && !islock())
	{
		$tmp=array();
		$tmp['refProduit'] = array();
		$tmp['qProduit'] = array();
		$tmp['prixProduit'] = array();
		$tmp['lock'] = $_SESSION['panier']['lock'];
		$i=0;
		while ($i < count($_SESSION['panier']['refProduit']))
		{
			if ($_SESSION['panier']['refProduit'][$i])
			{
				 array_push( $tmp['refProduit'],$_SESSION['panier']['refProduit'][$i]);
				 array_push( $tmp['qProduit'],$_SESSION['panier']['qProduit'][$i]);
				 array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
			}
			$i++;
		}
		$_SESSION['panier'] = $tmp;
		unset($tmp);
	}
	else {
		echo "Un probleme est survenu veuillez reessayer plus tard.";
	}
}
function modifArticle($refProduit, $qProduit)
{
	if (makePanier() && !islock())
	{
		if ($qProduit > 0)
		{
			echo "ref = ".$refProduit;
			foreach ($_SESSION['panier'] as $k) {
				$i=1;
				$rep = 0;
				foreach ((array)$k as $p)
				{				
					if ($i == 1 && $p == $refProduit)
						$rep = 1;
					if ($rep == 1 && $i == 3)
						$p -= 1;
					$i++;
				}
			}
			
		}
		else {
			delArticle($refProduit);
		}
	}
	else {
		echo "Un probleme est survenu veuillez reessayer plus tard.";
	}
}
function prixTotal()
{
	$total = 0;
	$i = 1;
	while ($i < count($_SESSION['panier']['refProduit']))
	{
		$total +=$_SESSION['panier']['refProduit'][$i] * $_SESSION['panier']['qProduit'][$i];
		$i++;
	}
	return $total;
}
?>
