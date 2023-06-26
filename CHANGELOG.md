# 4.0.0

- Обновлено до `extas=foundation` `v6`.
- Полностью переделаны `IPlayer`, `IPlayerIdentity`.
- Добавлен `IPlayerIdentityProvider`.

# 3.0.1

- Исправлена установка `extas.json`.

# 3.0.0

- Из `IPlayerIdentity` удалены интерфейсы `IHasPlayer`, `IHasPlayerIdentityDriver`.
- Добавлена сущность `IPlayerToIdentityMap`.
  - Таким образом, появилась возможность привязать несколько профилей к одной identity.
- В `extas.json` прописаны репозитории для identities, identities drivers.

# 2.0.0

- Параметры `identities/settings` у пользователя удалены.
- `Identities` выделены в сущность.
- `Settings` заменены на стандартные `sample parameters`.
- Добавлена поддержка различных драйверов для идентификации.
- Группы выделены в пакет.

# 1.*

- Модель пользователя.