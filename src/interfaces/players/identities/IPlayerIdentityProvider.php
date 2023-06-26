<?php
namespace extas\interfaces\players\identities;

use extas\interfaces\IHasClass;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IHaveUUID;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHaveParams;

/**
 * {
 *  "name": "keycloak",
 *  "title": "Keycloak",
 *  "description": "SSO Keycloak",
 *  "auth_url": "https://mykeycloak.some/realms/my-realm/protocol/openid-connect/auth",
 *  "token_url": "https://mykeycloak.some/realms/my-realm/protocol/openid-connect/token",
 *  "user_url": "https://mykeycloak.some/realms/my-realm/protocol/openid-connect/info",
 *  "scopes": ["email"]
 * }
 */
interface IPlayerIdentityProvider extends IItem, IHaveUUID, IHasName, IHasDescription
{
    public const SUBJECT = 'extas.player.identity.provider';

    public const FIELD__AUTHORIZATION_URL = 'auth_url';
    public const FIELD__ACCESS_TOKEN_URL = 'token_url';
    public const FIELD__USER_DETAILS_URL = 'user_url';
    public const FIELD__SCOPES = 'scopes';

    public function getAuthorizationUrl(): string;
    public function getAccessTokenUrl(): string;
    public function getUserDetailsUrl(): string;
    public function getScopes(): array;

    public function setAuthorizationUrl(string $url): static;
    public function setAccessTokenUrl(string $url): static;
    public function setUserDetailsUrl(string $url): static;
    public function setScopes(array $scopes): static;
}
