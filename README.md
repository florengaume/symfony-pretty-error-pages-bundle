
# Symfony Pretty Error Pages Bundle

Un bundle Symfony pour générer des pages d’erreur élégantes et personnalisables (Bootstrap),  
à partir d’un **template de base** et de **fichiers de langue** YAML (_fr_ et _en_ inclus),  
et une commande de génération automatique.  
Modifie le template ou tes textes, régénère toutes les pages d’un coup !

---

## 🗂️ Arborescence du bundle

```
symfony-pretty-error-pages-bundle/
│
├── templates/
│   └── error_base.html.twig           # Le template unique, personnalisable
│
├── translations/
│   ├── messages.fr.yaml               # Traductions françaises
│   └── messages.en.yaml               # Traductions anglaises
│
├── src/
│   └── Command/
│         └── GenerateErrorPagesCommand.php   # La commande de génération
│
├── composer.json
├── README.md
└── ... (autres fichiers du bundle)
```

---

## 🚀 Installation

1. **Ajoutez le bundle à votre projet Symfony :**

```bash
composer require florengaume/symfony-pretty-error-pages-bundle
```

2. **(Optionnel) Installez le composant translation si ce n’est pas déjà fait :**

```bash
composer require symfony/translation
```

---

## ⚙️ Utilisation

1. **Générez les pages d’erreur (français par défaut) :**

```bash
php bin/console pretty-error-pages:generate
```

2. **Pour générer en anglais :**

```bash
php bin/console pretty-error-pages:generate --lang=en
```

3. **Les pages sont créées (ou écrasées) ici :**

```
templates/bundles/TwigBundle/Exception/
├── error404.html.twig
├── error500.html.twig
├── error403.html.twig
└── error.html.twig
```

---

## ✏️ Personnalisation

- **Modifiez le template `error_base.html.twig`** à votre goût :  
  couleurs, design, structure, variables, etc.
- **Adaptez les fichiers de langue YAML** dans `translations/`  
  (Vous pouvez ajouter d’autres langues selon le même modèle).

Régénérez ensuite les pages avec la commande, tout sera mis à jour automatiquement.

---

## 🔄 Personnaliser le template de base (override optionnel)

Par défaut, le bundle utilise son propre template situé ici :

```
vendor/florengaume/symfony-pretty-error-pages-bundle/templates/error_base.html.twig
```

Si tu veux personnaliser ce template de base pour l'adapter à tes besoins sans modifier directement le bundle, fais ainsi :

### 📂 Étape 1 : Copier le template de base dans ton projet Symfony

```bash
mkdir -p templates/bundles/PrettyErrorPagesBundle
cp vendor/florengaume/symfony-pretty-error-pages-bundle/templates/error_base.html.twig templates/bundles/PrettyErrorPagesBundle/error_base.html.twig
```

### ✏️ Étape 2 : Personnalise ton template

Édite simplement ce fichier que tu viens de copier :

```
templates/bundles/PrettyErrorPagesBundle/error_base.html.twig
```

### 🚀 Étape 3 : Régénère les pages avec ton nouveau template

```bash
php bin/console pretty-error-pages:generate
```

Désormais, ton template personnalisé sera utilisé automatiquement à la place de celui du bundle.

---

## 🤝 Contribuer

- Forkez le repo, proposez vos PR pour d’autres langues, modèles, icônes ou options !
- Suggestions d’améliorations : issues ou discussions bienvenues

---

## 🛡️ Licence

MIT

---

**Auteur :** Florent Gaume  
[GitHub](https://github.com/florengaume)

---

> Pour toute question ou besoin d’extension, ouvrez une issue sur le dépôt !
