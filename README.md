
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

## 🗣️ Variables de langue prises en charge

Dans chaque entrée YAML, vous pouvez définir :

- `title` : `<title> ... </title>`
- `code` : numéro/code affiché (404, 500, etc. ou même emoji !)
- `code_color` : classe bootstrap couleur pour le code (ex : `text-danger`)
- `heading` : le titre principal de la page
- `message` : le texte d’explication (peut contenir du HTML)
- `button` : texte du bouton retour
- `button_class` : classe Bootstrap du bouton
- `lang` : code langue pour la balise `<html lang="...">`

Vous pouvez ajouter vos propres variables dans le template de base et dans le YAML.

---

## 🌍 Ajout d’une nouvelle langue

1. Copiez un fichier YAML existant (ex : `messages.fr.yaml`)
2. Traduisez-le, par ex : `messages.de.yaml`
3. Lancez :

```bash
php bin/console pretty-error-pages:generate --lang=de
```

---

## 🛠️ Exemple : Modifier le modèle ou une langue

- **Vous voulez changer le style Bootstrap ou le message ?**
  1. Modifiez `templates/error_base.html.twig` ou le fichier YAML dans `translations/`
  2. Relancez la commande : `php bin/console pretty-error-pages:generate`

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
