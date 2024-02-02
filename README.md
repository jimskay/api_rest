# API REST
Esta API é utilizada para login de usuários

Instalação do Laravel deste repositório:

no diretório do app:
$ composer update
$ php artisan key:generate
put database credentials in .env file
$ php artisan jwt:secret\n
4. Migrate and insert records\n
$ php artisan migrate\n
$ php artisan tinker\n
$ factory(App\User::class, 10)->create()\n
$ factory(App\Task::class, 50)->create()\n

## Endpoints

### POST api/users/login
Esse endpoint é responsável por fazer o processo de login.
#### Parametros form-data

login: Username do usuário cadastrado no sistema.
senha: Senha do usuário cadastrado no sistema, com aquele determinado Username.

Exemplo:

```
email: leandro@changed.com.br
password: 123456
```

#### Respostas
##### OK! 200
Caso essa resposta aconteça você vai receber token JWT para conseguir acessar endpoints protegidos na API.
Exemplo de resposta:

```

{
    "status": true,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzA2OTA2NTcyLCJleHAiOjE3MDY5MTAxNzIsIm5iZiI6MTcwNjkwNjU3MiwianRpIjoiRTk0VEcyV0xoNkFaNHdVYyIsInN1YiI6IjIiLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.CxEo6i8DT3rlnvBQJI6Zw7lZ9oXnl2Q0vfzFSR9FMzw"
}

```

##### Token Inválido! 403

```
{
    "dados": "token invalido."
}

```

##### Falha na autenticação! 401
Caso essa resposta aconteça, isso significa que aconteceu alguma falha durante o processo de autenticação da requisição. Motivos: Token inválido, Token expirado.


### GET api/users/{userId}
Esse endpoint é responsável por retornar o usuario específico.
#### Parametros Bearer Token
Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiTGVhbmRybyBSb2NoYSIsImV4cGlyZXNfaW4iOjE3MDY4ODY0Mzh9.FvfWnOfMKVUv002KVPykVI0rHBkWHCAlfVRZ4vaKbl0
#### Respostas
##### OK! 200
Caso essa resposta aconteça você vai receber a listagem de todos os usuários.
Exemplo de resposta:

```

    {
        "id": 1,
        "name": "Antone Block",
        "email": "phermann@example.org",
        "created_at": "2024-02-02T14:56:31.000000Z"
    }

```
##### Exemplo de chamada CURL:
```
curl -X GET \
  --url 'http://localhost/api/users{userId}' \
  -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiTmV0byBDb3N0YSIsImV4cGlyZXNfaW4iOjE3MDU3NDEwNjZ9.WgwRzY7Wp41UqiZ4mAOay13_DR-mdZpun7ehzDR87-w'
```

##### Falha na autenticação! 401
Caso essa resposta aconteça, isso significa que aconteceu alguma falha durante o processo de autenticação da requisição. Motivos: Token inválido, Token expirado.

### GET api/users
Esse endpoint é responsável por retornar a listagem de todos os usuarios cadastrados no banco de dados.
#### Parametros Bearer Token
Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiTGVhbmRybyBSb2NoYSIsImV4cGlyZXNfaW4iOjE3MDY4ODY0Mzh9.FvfWnOfMKVUv002KVPykVI0rHBkWHCAlfVRZ4vaKbl0
#### Respostas
##### OK! 200
Caso essa resposta aconteça você vai receber a listagem de todos os usuários.
Exemplo de resposta:

```

 {
        "id": 1,
        "name": "Antone Block",
        "email": "phermann@example.org",
        "created_at": "2024-02-02T14:56:31.000000Z"
    },
    {
        "id": 2,
        "name": "Leandro changed",
        "email": "leandro@changed.com.br",
        "created_at": "2024-02-02T14:56:31.000000Z"
    },
 ...
.
.
.

```
##### Exemplo de chamada CURL:
```
curl -X GET \
  --url 'http://localhost/api/users' \
  -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiTmV0byBDb3N0YSIsImV4cGlyZXNfaW4iOjE3MDU3NDEwNjZ9.WgwRzY7Wp41UqiZ4mAOay13_DR-mdZpun7ehzDR87-w'
```

##### Falha na autenticação! 401
Caso essa resposta aconteça, isso significa que aconteceu alguma falha durante o processo de autenticação da requisição. Motivos: Token inválido, Token expirado.



### POST api/users/ - create
Esse endpoint é responsável por fazer o cadastro de um novo usuario.
#### Parametros do tipo form-data

name: leandro
email: Username do usuário cadastrado no sistema.
password: Senha do usuário cadastrado no sistema, com aquele determinado Username.

Exemplo:

```
name: leandro
email: leandro@teste.com.br
password: 123456
```
#### Respostas
##### OK! 201 - HTTP_CREATED
Caso essa resposta aconteça você vai receber a listagem de todos os usuários.
Exemplo de resposta:

```

{
    "status": true,
    "user": {
        "name": "Leandro",
        "email": "teste6@teste.com.br",
        "updated_at": "2024-02-02T19:50:42.000000Z",
        "created_at": "2024-02-02T19:50:42.000000Z",
        "id": 16
    },
    "http_code": 201
}

```

##### Falha na autenticação! 401
Caso essa resposta aconteça, isso significa que aconteceu alguma falha durante o processo de autenticação da requisição. Motivos: Token inválido, Token expirado.

##### ERRO

Exemplo de resposta:
```
{
    "status": false,
    "http_code": 200,
    "message": {
        "validator": {
            "customMessages": {
                "required": "Atributo requerido",
                "unique": "Atributo único"
            },
            "fallbackMessages": [],
            "customAttributes": [],
            "customValues": [],
            "extensions": [],
            "replacers": []
        },
        "response": null,
        "status": 422,
        "errorBag": "default",
        "redirectTo": null
    }
}

```

### PUT api/users/{userId}
Esse endpoint é responsável por fazer o cadastro de um novo usuario.
#### Parametros do tipo form-data

name: leandro
email: Username do usuário cadastrado no sistema.
password: Senha do usuário cadastrado no sistema, com aquele determinado Username.

Exemplo:

```
name: leandro
email: leandro@teste.com.br
```

#### Respostas
##### OK! 200
Caso essa resposta aconteça você vai receber token JWT para conseguir acessar endpoints protegidos na API.
Exemplo de resposta:

```

{
    "status": true,
    "user": {
        "id": 3,
        "name": "Leandro sds",
        "email": "teste@changedw.com.br",
        "email_verified_at": "2024-02-02T14:56:30.000000Z",
        "created_at": "2024-02-02T14:56:31.000000Z",
        "updated_at": "2024-02-02T20:31:08.000000Z"
    }
}

```


##### Falha na autenticação! 401
Caso essa resposta aconteça, isso significa que aconteceu alguma falha durante o processo de autenticação da requisição. Motivos: Token inválido, Token expirado.

### DELETE api/users/{userId}
Esse endpoint é responsável por fazer o cadastro de um novo usuario.
#### Parametros 
Nenhum
#### Respostas
##### OK! 200
Caso essa resposta aconteça você vai receber token JWT para conseguir acessar endpoints protegidos na API.
Exemplo de resposta:

```

{
    "status": true,
    "user": {
        "id": 1,
        "name": "Antone Block",
        "email": "phermann@example.org",
        "email_verified_at": "2024-02-02T14:56:30.000000Z",
        "created_at": "2024-02-02T14:56:31.000000Z",
        "updated_at": "2024-02-02T14:56:31.000000Z"
    }
}

```


##### Falha na autenticação! 401
Caso essa resposta aconteça, isso significa que aconteceu alguma falha durante o processo de autenticação da requisição. Motivos: Token inválido, Token expirado.

