# API CRUD - Gestion des utilisateurs

Cette API permet de gérer des utilisateurs à travers des opérations CRUD (Create, Read, Update, Delete). Elle utilise une base de données SQLite via PDO en PHP.

## Endpoints

### 1. `GET /users`

#### Description
Récupère la liste de tous les utilisateurs.

#### Réponse
- **Code :** `200 OK`
- **Contenu :**
  ```json
  [
    {
        "id": 1,
        "name": "lea",
        "email": "lea.test@gmail.com"
    },
    {
        "id": 2,
        "name": "user2",
        "email": "user2.test@gmail.com"
    },
    {
        "id": 3,
        "name": "user3",
        "email": "user3.test@gmail.com"
    },
    {
        "id": 4,
        "name": "riri",
        "email": "riri@disney.com"
    },
    {
        "id": 5,
        "name": "fifi",
        "email": "fifi@disney.com"
    },
    {
        "id": 6,
        "name": "loulou",
        "email": "loulou@disney.com"
    },
    {
        "id": 9,
        "name": "lealine",
        "email": "lealine@yahoo.com"
    }
  ]


### 2. `POST /users`

#### Description
Crée un nouvel utilisateur.

#### Réponse
- **Code :** `201 Created`
- **Contenu : Renvoie l'ID de l'utilisateur crée et rajoute ses informations dans la base de données**

    ```json
    [
    {
    "id": 10
    }
    ]

- **Code si erreur:** `400`



### 3. `PUT /users`

#### Description
Permet de modifier les informations (nom, email ou les 2) d'un utilisateur déjà présent dans la base.


#### Réponse
- **Code :** `200 OK`
- **Contenu : Renvoie les nouvelles informations de l'utilisateur**

    ```json
    [
    {"id":10,"name":"teeeeesssst","email":"tessst@gmail.com"}
    ]

- **Code si erreur:** `400`

### 4. `DELETE /users`

#### Description
Permet de supprimer un utilisateur.

- **Code :** `200 OK`
- **Contenu : Renvoie une confirmation de suppression de l'utilisateur désigné**

    ```json
    [
        stdClass Object
    (
        [id
    ] => 10
        [name
    ] => teeeeesssst
        [email
    ] => tessst@gmail.com
    )
    "The user : teeeeesssst with email : tessst@gmail.com has been deleted"
    ]


- **Code si erreur:** `400`