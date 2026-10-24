---
name: Linkindle
category: other
start_year: 2016
end_year: null
featured: true
short_description:
  en: Display your energy consumption trends right from your Linky, onto a Kindle
  fr: Affichez le graphe de votre consommation énergétique directement depuis votre Linky, sur une Kindle
downloads:
- platform: Python 3
  url: https://github.com/outadoc/linkindle/archive/master.zip
  source: http://github.com/outadoc/linkindle
  price: 0
  version: '1.0'
description_fr: |
  J'avais envie d'afficher mes graphes de consommation énergétique sur mon mur, comme avec une station météorologique. Après avoir évalué les solutions d'affichage, j'ai compris que l'afficheur le plus adapté et peu consommateur serait une Kindle, que je rafraîchirai périodiquement afin d'afficher les dernières données.

  J'ai ainsi commencé à concevoir un générateur de graphe qui récupérerait les données reportées par mon compteur Linky. Les données sont envoyées périodiquement à Enedis, qui fournit alors une page web pour les consulter - et les rend disponible à travers une API JSON privée.

  Quelques heures plus tard, j'avais un script Python qui pouvait se connecter au site d'Enedis et télécharger les données de mon compteur. Les données sont ensuite traitées par Python *via* `matplotlib`, pour générer des fichiers PNG de graphes affichables sur la Kindle, une fois jailbreakée.

  Visitez le repo Github ansi que [ce post de blog](https://outadoc.fr/2016/12/linkindle-courbe-conso-electrique-sur-liseuse/) pour plus d'infos !
---
I wanted a way to display my energetic consumption on my wall, like on a weather station. I looked into different display solutions, and it turns out the nicest and easiest seems to be hacking a Kindle into displaying images refreshed periodically.

I therefore started making a graph generator that would take the data reported by my Linky electricity meter. The data is sent periodically to Enedis, which in turn offers a webpage which displays it - and makes it available through a private JSON API.

A few hours later, I had a Python script that could log into the Enedis website and download the meter's data. It can then be processed by the Python script, to generate PNG files of graphs that I will then display on the jailbroken Kindle.

Check the Github repository and [this blog post (fr)](https://outadoc.fr/2016/12/linkindle-courbe-conso-electrique-sur-liseuse/) for more info!
