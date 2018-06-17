```bash
composer require "gesdinet/jwt-refresh-token-bundle"
```

_[config/routes.yaml](config/routes.yaml)_
```diff
app.swagger_ui:
    path: /api/doc
    methods: GET
    defaults: { _controller: nelmio_api_doc.controller.swagger_ui }
++ gesdinet_jwt_refresh_token:
++   path:     /api/token/refresh
++   defaults: { _controller: gesdinet.jwtrefreshtoken:refresh }
```

_[config/packages/security.yaml](config/packages/security.yaml)_
```diff
    firewalls:
++      refresh:
++          pattern:  ^/api/token/refresh
++          stateless: true
++          anonymous: true     
        login:
            pattern:  ^/api/login
            stateless: true
            anonymous: true
            form_login:
                check_path:               /api/login_check
                success_handler:          lexik_jwt_authentication.handler.authentication_success
                failure_handler:          lexik_jwt_authentication.handler.authentication_failure
                require_previous_session: false
    # ...  
    access_control:
++      - { path: ^/api/token/refresh, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/api/login_check, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/api/register, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/api/v1,       roles: IS_AUTHENTICATED_FULLY }                  
```

With the next command you will create a new table to handle your refresh tokens

```bash
php app/console doctrine:schema:update --force
```
