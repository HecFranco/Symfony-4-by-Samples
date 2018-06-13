---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 04_LexikJWTAuthenticationBundle`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Security Component](https://symfony.com/doc/4.0/components/security.html), `composer require symfony/security`
* [](), `composer require symfony/orm-pack`
* [](), `composer require symfony/web-server-bundle`
* [](), `composer require symfony/var-dumper`

## Sources

### Extras

* [xdebug](https://xdebug.org/download.php), php extension for debug the code.(Note: [How to configure xdebug with WAMP](https://stackoverflow.com/questions/8712462/how-to-configure-xdebug-with-wamp?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa))
* [lexik-jwt-authentication-sandbox](https://github.com/chalasr/lexik-jwt-authentication-sandbox/tree/flex)

### Bundles

* [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle), using the next command to install it `composer require lexik/jwt-authentication-bundle`

_[config/bundles.php](./config/bundles.php)_
```diff
<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
++  Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle::class => ['all' => true],
];
```

Generate the SSH keys :

```bash
mkdir -p config/jwt # For Symfony4, no need of the -p option
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

_[config/packages/security.yaml](./config/packages/security.yaml)_
```diff
security: 
++  encoders:    
++      App\Entity\User:
++          algorithm: bcrypt             
    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    providers:
--      in_memory: { memory: ~ }
++      # in_memory: { memory: ~ }
++      entity_provider:
++          entity:
++              class: App\Entity\User
++              property: username   
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
--      main:
++      # main:
--          anonymous: true            
++          # anonymous: true
            # activate different ways to authenticate

            # http_basic: true
            # https://symfony.com/doc/current/security.html#a-configuring-how-your-users-will-authenticate

            # form_login: true
            # https://symfony.com/doc/current/security/form_login_setup.html
++      login:
++          pattern:  ^/login
++          stateless: true
++          anonymous: true
++          json_login:
++              check_path: /login_check
++              success_handler: lexik_jwt_authentication.handler.authentication_success
++              failure_handler: lexik_jwt_authentication.handler.authentication_failure
++      register:
++          pattern:  ^/register
++          stateless: true
++          anonymous: true
++      api:
++          pattern:  ^/api
++          stateless: true
++          anonymous: false
++          provider: entity_provider
++          guard:
++              authenticators:
++                  - lexik_jwt_authentication.jwt_token_authenticator
    # Easy way to control access for large sections of your site
    # Note: Only the *first* access control that matches will be used
    access_control:
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }   
++      - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
++      - { path: ^/register, roles: IS_AUTHENTICATED_ANONYMOUSLY }
++      - { path: ^/api, roles: IS_AUTHENTICATED_FULLY }
```