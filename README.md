# API REST
Esta API é utilizada para login de usuários

## Endpoints

### POST api/users/login
Esse endpoint é responsável por fazer o processo de login.
#### Parametros form-data

login: Username do usuário cadastrado no sistema.
senha: Senha do usuário cadastrado no sistema, com aquele determinado Username.

Exemplo:

```
login: leandro
senha: 123456
```

#### Respostas
##### OK! 200
Caso essa resposta aconteça você vai receber token JWT para conseguir acessar endpoints protegidos na API.
Exemplo de resposta:

```

{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiTGVhbmRybyBSb2NoYSIsImV4cGlyZXNfaW4iOjE3MDY4ODY0Mzh9.FvfWnOfMKVUv002KVPykVI0rHBkWHCAlfVRZ4vaKbl0",
    "data": {
        "id": "1",
        "name": "Leandro Rocha",
        "expires_in": 1706886438
    }
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
Esse endpoint é responsável por criar ou cadastrar um novo usuário.
#### Parametros Bearer Token

Token: Bearer Token gerado no Login.

Exemplo:
Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiTGVhbmRybyBSb2NoYSIsImV4cGlyZXNfaW4iOjE3MDY4ODY0Mzh9.FvfWnOfMKVUv002KVPykVI0rHBkWHCAlfVRZ4vaKbl0

#### Respostas
##### OK! 200
Caso essa resposta aconteça você vai receber a listagem de todos os usuários.
Exemplo de resposta:

```

{
    "dados": "Dados foram inseridos com sucesso."
}

```

##### Falha na autenticação! 401
Caso essa resposta aconteça, isso significa que aconteceu alguma falha durante o processo de autenticação da requisição. Motivos: Token inválido, Token expirado.

