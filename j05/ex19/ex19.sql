SELECT ABS(DATEDIFF(MAX(date_debut_affiche), MIN(date_fin_affiche))) AS 'uptime' FROM film GROUP BY id_film;
