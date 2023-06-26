<?php
namespace extas\components\players\identities;

use extas\components\Item;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasStringId;
use extas\interfaces\players\identities\IPlayerIdentityProvider;

class PlayerIdentityProvider extends Item implements IPlayerIdentityProvider
{
    use THasName;
    use THasStringId;
    use THasDescription;

    public function getAuthorizationUrl(): string
    {
        return $this->config[static::FIELD__AUTHORIZATION_URL] ?? '';
    }

    public function getAccessTokenUrl(): string
    {
        return $this->config[static::FIELD__ACCESS_TOKEN_URL] ?? '';
    }

    public function getUserDetailsUrl(): string
    {
        return $this->config[static::FIELD__USER_DETAILS_URL] ?? '';
    }

    public function getScopes(): array
    {
        return $this->config[static::FIELD__SCOPES] ?? '';
    }

    public function setAuthorizationUrl(string $url): static
    {
        $this->config[static::FIELD__AUTHORIZATION_URL] = $url;

        return $this;
    }

    public function setAccessTokenUrl(string $url): static
    {
        $this->config[static::FIELD__ACCESS_TOKEN_URL] = $url;

        return $this;
    }

    public function setUserDetailsUrl(string $url): static
    {
        $this->config[static::FIELD__USER_DETAILS_URL] = $url;

        return $this;
    }

    public function setScopes(array $scopes): static
    {
        $this->config[static::FIELD__SCOPES] = $scopes;

        return $this;
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
