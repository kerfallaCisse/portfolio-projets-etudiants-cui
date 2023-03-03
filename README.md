# Portail de projets d'étudiants au CUI
Création d'un portail sous forme de portofolio, permettant aux étudiants du Centre Universitaire d'Informatique (CUI) de présenter, préserver les projets qu'ils ont effectués durant leurs années d'études au CUI.

## Politique d'utilisation du Git
Pour les messages de commit : utiliser les conventions de commit voir https://www.conventionalcommits.org/en/v1.0.0/ 
Les éléments qui seront généralement utilisés dans les messages de commit sont les suivants : 
-	```fix```: pour fixer un bug,
-	```test``` : pour les tests,
-	```feat``` : lorsqu’on crée une nouvelle fonctionnalité,
-	```chore``` : c’est pour la réalisation des tâches fastidieuses. Lorsque la tâche à effectuer ne nécessite pas de mettre à jour du code, etc. 
-	```docs``` : pour la documentation,
-	refactor : mettre à jour du code, etc.

Format: ```<type>(<scope>): <sujet>```
```<scope>``` est optionnel. Mais nécessaire dans certains cas. Exemple : lorsqu’on crée une nouvelle fonctionnalité, mise à jour.

***Usage*** :
```feat```: création de la vue étudiant (message spécifiant de manière brève l’objectif).

***Autre exemple*** :
feat(vue_etudiant) : création de la vue étudiant.

### Politique des branches 
-	Garder nos branches respectives,
-	Tout ce qui est sur la branche master est fonctionnel,
-	On crée une branche pour chaque fonctionnalité,
-	On crée une branche d’intégration pour les fonctionnalités (branche develop). Quand le développement d’une fonctionnalité est complet, merger sur la branche develop. C’est cette branche qui sera ensuite merger sur la branche master.


