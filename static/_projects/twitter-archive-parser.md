---
name: Twitter Archive Parser
category: other
start_year: 2012
end_year: 2012
thumbnail: a0b8a6ab06657ae0cbac6d6fa7662bff8c7fa00c.png
short_description:
  en: Store all of your tweets in a single database.
  fr: Stockez tous vos tweets dans une base de données unifiée.
screenshots:
- 8690ee7c0428c2bf057193d9735584512a2cebf7.png
- 7fc14829e6a59281c0bed4fdd297e89ecc0bb0e2.png
- e7523be114f09ad50b996426935fb8a113b8f5ec.png
downloads:
- platform: Unknown
  url: https://github.com/outadoc/twitter-archive-parser/zipball/master
  source: https://github.com/outadoc/twitter-archive-parser/
  price: 0
  version: '1.0'
description_fr: |
  Avant que Twitter ne propose le téléchargement individuel des données personnelles de ses utilisateurs, il n'existait pas de moyen direct d'obtenir une archive contenant ses tweets.

  Si vous étiez citoyen de l'Union Européenne cependant, il était possible de demander une telle archive à Twitter; seulement, celle-ci étant difficile à exploiter, j'ai créé un outil permettant d'analyser l'archive et insérer les tweets dans une base de données SQLite.

  L'outil est disponible sur Github, mais ne fonctionnera pas avec les archives distribuées dernièrement par Twitter *via* leur site web.
---
Before Twitter introduced its archiving system, there was no way to download all your personal information from their servers and save it on your computer.

There was a workaround, though; but you had to live in the **European Union** to request it.
If it was your case, you had to follow [these instructions](https://www.privacyinternational.org/blog/what-does-twitter-know-about-its-users-nologs), and wait a few days for Twitter to send you your tweets in an archive.

Then, only had to clone this project on your server or computer, and follow the instructions on the Github repo to get a nice SQLite database containing your tweets!

This script will **not** work with the newer archives provided by Twitter *via* their website.
